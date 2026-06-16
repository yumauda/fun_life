import fs from 'node:fs/promises';
import path from 'node:path';
import zlib from 'node:zlib';
import { execFile } from 'node:child_process';
import { promisify } from 'node:util';

const execFileAsync = promisify(execFile);

const OUT_DIR = path.resolve('src/images/__dummy__');

function crc32(buf) {
  // Standard CRC32 (IEEE 802.3)
  let crc = 0xffffffff;
  for (let i = 0; i < buf.length; i += 1) {
    crc ^= buf[i];
    for (let j = 0; j < 8; j += 1) {
      const mask = -(crc & 1);
      crc = (crc >>> 1) ^ (0xedb88320 & mask);
    }
  }
  return (crc ^ 0xffffffff) >>> 0;
}

function chunk(type, data) {
  const typeBuf = Buffer.from(type, 'ascii');
  const lenBuf = Buffer.alloc(4);
  lenBuf.writeUInt32BE(data.length, 0);
  const crcBuf = Buffer.alloc(4);
  const crcVal = crc32(Buffer.concat([typeBuf, data]));
  crcBuf.writeUInt32BE(crcVal, 0);
  return Buffer.concat([lenBuf, typeBuf, data, crcBuf]);
}

function pngRGBA({ width, height, pixelAt }) {
  const signature = Buffer.from([0x89, 0x50, 0x4e, 0x47, 0x0d, 0x0a, 0x1a, 0x0a]);

  const ihdr = Buffer.alloc(13);
  ihdr.writeUInt32BE(width, 0);
  ihdr.writeUInt32BE(height, 4);
  ihdr[8] = 8; // bit depth
  ihdr[9] = 6; // color type RGBA
  ihdr[10] = 0; // compression
  ihdr[11] = 0; // filter
  ihdr[12] = 0; // interlace

  const bytesPerPixel = 4;
  const stride = width * bytesPerPixel;
  const raw = Buffer.alloc((stride + 1) * height);

  for (let y = 0; y < height; y += 1) {
    const rowStart = y * (stride + 1);
    raw[rowStart] = 0; // filter type 0 (None)
    for (let x = 0; x < width; x += 1) {
      const [r, g, b, a] = pixelAt(x, y);
      const i = rowStart + 1 + x * 4;
      raw[i + 0] = r;
      raw[i + 1] = g;
      raw[i + 2] = b;
      raw[i + 3] = a;
    }
  }

  const idat = zlib.deflateSync(raw, { level: 9 });

  const png = Buffer.concat([
    signature,
    chunk('IHDR', ihdr),
    chunk('IDAT', idat),
    chunk('IEND', Buffer.alloc(0))
  ]);

  return png;
}

function clampByte(n) {
  return Math.max(0, Math.min(255, n | 0));
}

function makePatternPixelAt(seed) {
  // High compressibility: blocks + stripes + subtle gradient
  return (x, y) => {
    const block = ((x >> 5) + (y >> 5) + seed) % 6;
    const stripe = ((x + seed * 13) % 40) < 6 ? 1 : 0;
    const grad = ((x * 255) / 1024) | 0;

    const base = [
      [30, 110, 200],
      [60, 180, 80],
      [180, 60, 120],
      [220, 180, 40],
      [90, 60, 200],
      [40, 200, 200]
    ][block];

    const r = clampByte(base[0] + (stripe ? 25 : 0) + (grad >> 3));
    const g = clampByte(base[1] + (stripe ? 10 : 0));
    const b = clampByte(base[2] + (stripe ? 35 : 0));
    return [r, g, b, 255];
  };
}

async function writeFileIfMissing(filePath, buf) {
  try {
    await fs.access(filePath);
    return false;
  } catch {
    await fs.writeFile(filePath, buf);
    return true;
  }
}

async function main() {
  await fs.mkdir(OUT_DIR, { recursive: true });

  const created = [];
  for (let i = 1; i <= 10; i += 1) {
    const width = 640 + i * 48;
    const height = 360 + i * 36;
    const name = `dummy_${String(i).padStart(2, '0')}_${width}x${height}.png`;
    const outPath = path.join(OUT_DIR, name);

    const png = pngRGBA({
      width,
      height,
      pixelAt: makePatternPixelAt(i)
    });

    const didCreate = await writeFileIfMissing(outPath, png);
    if (didCreate) created.push(outPath);
  }

  // Convert a few PNGs to JPG for testing (macOS built-in `sips`)
  // Only create if missing.
  const jpgTargets = [1, 3, 5, 7, 9];
  for (const i of jpgTargets) {
    const width = 640 + i * 48;
    const height = 360 + i * 36;
    const pngName = `dummy_${String(i).padStart(2, '0')}_${width}x${height}.png`;
    const jpgName = `dummy_${String(i).padStart(2, '0')}_${width}x${height}.jpg`;
    const pngPath = path.join(OUT_DIR, pngName);
    const jpgPath = path.join(OUT_DIR, jpgName);

    try {
      await fs.access(jpgPath);
      continue;
    } catch {
      // continue
    }

    await execFileAsync('sips', [
      '-s',
      'format',
      'jpeg',
      '-s',
      'formatOptions',
      '80',
      pngPath,
      '--out',
      jpgPath
    ]);
    created.push(jpgPath);
  }

  console.log(`✓ Dummy images ready in: ${OUT_DIR}`);
  console.log(`✓ Newly created files: ${created.length}`);
}

main().catch(err => {
  console.error(err);
  process.exit(1);
});

