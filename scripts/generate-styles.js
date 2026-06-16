import fs from 'fs/promises';
import path from 'path';
import { glob } from 'glob';

async function generateStylesScss() {
  const baseDir = 'src/sass';
  const outputFile = path.join(baseDir, 'styles.scss');
  const categories = ['global', 'base', 'layout', 'project', 'component'];
  let content = '';

  for (const category of categories) {
    // Check if _index.scss exists for this category
    const indexFile = path.join(baseDir, category, '_index.scss');
    let hasIndex = false;
    try {
      await fs.access(indexFile);
      hasIndex = true;
    } catch (error) {
      hasIndex = false;
    }

    if (hasIndex) {
      // If _index.scss exists, use it
      content += `// ${category.charAt(0).toUpperCase() + category.slice(1)}\n`;
      content += `@use "./${category}";\n\n`;
    } else {
      // Otherwise, import individual files
      const files = await glob(`${baseDir}/${category}/*.scss`, {
        ignore: [`${baseDir}/${category}/_index.scss`]
      });

      if (files.length > 0) {
        content += `// ${category.charAt(0).toUpperCase() + category.slice(1)}\n`;
        files.sort();
        for (const file of files) {
          const relativePath = `./${category}/${path.basename(file, '.scss')}`;
          content += `@use "${relativePath}";\n`;
        }
        content += '\n';
      }
    }
  }

  await fs.writeFile(outputFile, content.trim() + '\n', 'utf-8');
  console.log('✓ styles.scss generated successfully!');
}

generateStylesScss().catch(error => {
  console.error('Error generating styles.scss:', error);
  process.exit(1);
});
