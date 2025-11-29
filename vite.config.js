import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin';
import path from 'path';

export default defineConfig({
  plugins: [
    vue({ template: { transformAssetUrls } }),
    quasar({ sassVariables: 'resources/css/quasar-variables.sass' }),
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
      buildDirectory: 'build', // <- ini buat output ke public/build
    }),
  ],
  build: {
    outDir: 'public/build',
    emptyOutDir: true,   // hapus build lama otomatis
    manifest: true,      // generate manifest.json
  },
  resolve: {
    alias: { '@': path.resolve(__dirname, 'resources/js') },
  },
});
