const fs = require('fs');
const path = require('path');

const source = path.resolve(__dirname, 'public/build/.vite/manifest.json');
const dest = path.resolve(__dirname, 'public/build/manifest.json');

if (fs.existsSync(source)) {
  fs.renameSync(source, dest);
  console.log('✅ manifest.json dipindahkan ke public/build');
} else {
  console.log('⚠️ manifest.json tidak ditemukan di .vite');
}
