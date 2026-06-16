import imagemin from 'imagemin';
import imageminMozjpeg from 'imagemin-mozjpeg';
import imageminPngquant from 'imagemin-pngquant';
import imageminSvgo from 'imagemin-svgo';
import imageminWebp from 'imagemin-webp';
import { glob } from 'glob';
import path from 'path';
import fs from 'node:fs/promises';

const SRC_ROOT = path.resolve('src/images');
const DEST_ROOT = path.resolve('images');
const CACHE_PATH = path.resolve('.cache/image-compress.json');
const CACHE_VERSION = 'v1-mozjpeg80-pngquant65-90-webp80-svgoKeepViewBox';
const FORCE = process.argv.includes('--force');

async function ensureDir(dirPath) {
  await fs.mkdir(dirPath, { recursive: true });
}

async function readCache() {
  try {
    const raw = await fs.readFile(CACHE_PATH, 'utf8');
    const parsed = JSON.parse(raw);
    if (!parsed || typeof parsed !== 'object') return { version: CACHE_VERSION, entries: {} };
    if (parsed.version !== CACHE_VERSION) return { version: CACHE_VERSION, entries: {} };
    if (!parsed.entries || typeof parsed.entries !== 'object')
      return { version: CACHE_VERSION, entries: {} };
    return parsed;
  } catch {
    return { version: CACHE_VERSION, entries: {} };
  }
}

async function writeCache(cache) {
  await ensureDir(path.dirname(CACHE_PATH));
  await fs.writeFile(CACHE_PATH, `${JSON.stringify(cache, null, 2)}\n`, 'utf8');
}

async function fileExists(filePath) {
  try {
    await fs.access(filePath);
    return true;
  } catch {
    return false;
  }
}

async function compressImages() {
  const imageFiles = await glob('src/images/**/*.{jpg,jpeg,png,svg,gif,webp}', {
    absolute: true,
    nodir: true
  });

  console.log(`Found ${imageFiles.length} source images to process...`);

  const cache = await readCache();

  let skippedFiles = 0;
  let copied = 0;
  let compressed = 0;
  let webpCreated = 0;
  let netDeltaBytes = 0;

  for (const file of imageFiles) {
    const srcStat = await fs.stat(file);
    const ext = path.extname(file).toLowerCase();
    const relPath = path.relative(SRC_ROOT, file);
    const destFile = path.join(DEST_ROOT, relPath);
    const destDir = path.dirname(destFile);

    await ensureDir(destDir);

    const prev = cache.entries[relPath];
    const destExists = await fileExists(destFile);
    const expectsWebp = ext === '.jpg' || ext === '.jpeg' || ext === '.png';
    const expectedWebpFile = expectsWebp
      ? path.join(destDir, `${path.basename(file, ext)}.webp`)
      : null;
    const webpExists = expectsWebp && expectedWebpFile ? await fileExists(expectedWebpFile) : true;

    const needsProcess =
      FORCE ||
      !prev ||
      prev.srcMtimeMs !== srcStat.mtimeMs ||
      prev.srcSize !== srcStat.size ||
      !destExists ||
      !webpExists;

    if (!needsProcess) {
      skippedFiles += 1;
      continue;
    }

    // GIF/WebPは再圧縮せずコピーのみ（劣化/無駄な再処理を避ける）
    if (ext === '.gif' || ext === '.webp') {
      const beforeSize = (await fileExists(destFile)) ? (await fs.stat(destFile)).size : 0;
      await fs.copyFile(file, destFile);
      copied += 1;
      const afterSize = (await fs.stat(destFile)).size;
      netDeltaBytes += beforeSize - afterSize;

      cache.entries[relPath] = {
        type: ext.slice(1),
        srcMtimeMs: srcStat.mtimeMs,
        srcSize: srcStat.size,
        destSize: afterSize,
        webpSize: null
      };
      continue;
    }

    const beforeSize = (await fileExists(destFile)) ? (await fs.stat(destFile)).size : 0;

    // 元の画像（jpg/png/svg）を、src → images に出力（圧縮）
    const plugins = [];
    if (ext === '.jpg' || ext === '.jpeg') {
      plugins.push(imageminMozjpeg({ quality: 80 }));
    } else if (ext === '.png') {
      plugins.push(imageminPngquant({ quality: [0.65, 0.9] }));
    } else if (ext === '.svg') {
      plugins.push(
        imageminSvgo({
          plugins: [{ name: 'removeViewBox', active: false }]
        })
      );
    }

    // 念のため：対象外拡張子が混ざった場合はコピーにフォールバック
    if (plugins.length === 0) {
      await fs.copyFile(file, destFile);
      copied += 1;
    } else {
      // 「サイズが増えても必ず圧縮版を採用する」方針
      await imagemin([file], {
        destination: destDir,
        plugins
      });
      compressed += 1;

      // 何らかの理由で出力が生成されなかった場合はコピーにフォールバック
      if (!(await fileExists(destFile))) {
        await fs.copyFile(file, destFile);
        copied += 1;
      }
    }

    const afterSize = (await fs.stat(destFile)).size;
    netDeltaBytes += beforeSize - afterSize;

    let webpSize = null;

    // JPGとPNGをWebPに変換
    if (expectsWebp && expectedWebpFile) {
      try {
        const results = await imagemin([file], {
          destination: destDir,
          plugins: [imageminWebp({ quality: 80 })]
        });

        // imageminが返すdestinationPathを優先（ファイル名差異や生成失敗に強くする）
        const first = results?.[0];
        const actualPath = first?.destinationPath;

        if (actualPath && actualPath !== expectedWebpFile) {
          // 期待パスに寄せる（watcher等の参照先を固定）
          try {
            await fs.rm(expectedWebpFile, { force: true });
          } catch {
            // ignore
          }
          await fs.rename(actualPath, expectedWebpFile);
        }

        if (first?.data && first.data.length) {
          webpSize = first.data.length;
          webpCreated += 1;
        } else if (await fileExists(expectedWebpFile)) {
          webpSize = (await fs.stat(expectedWebpFile)).size;
          webpCreated += 1;
        } else {
          // 生成されなかった場合はキャッシュ上webpSize=nullのまま（次回needsProcessで再試行）
          webpSize = null;
        }
      } catch (e) {
        // WebP生成でコケても、全体タスクは止めない
        console.warn(`WebP conversion failed: ${relPath}`);
        console.warn(e);
        webpSize = null;
      }
    }

    cache.entries[relPath] = {
      type: ext.slice(1),
      srcMtimeMs: srcStat.mtimeMs,
      srcSize: srcStat.size,
      destSize: afterSize,
      webpSize
    };
  }

  await writeCache(cache);

  console.log(
    `✓ Done. compressed: ${compressed}, webp: ${webpCreated}, copied: ${copied}, skipped: ${skippedFiles}, net: ${netDeltaBytes} bytes`
  );
}

compressImages().catch(error => {
  console.error('Error compressing images:', error);
  process.exit(1);
});
