import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { quasar } from '@quasar/vite-plugin';

export default defineConfig({
  plugins: [
    vue(),
    quasar({
      sassVariables: 'resources/css/quasar-variables.sass'
    }),
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/build',   // pastikan build ke folder yang Laravel pakai
    emptyOutDir: true,        // hapus build lama sebelum build baru
    manifest: true,           // generate manifest.json
  },
  resolve: {
    alias: {
      '@': '/resources/js',  // optional, supaya import Vue lebih rapi
    },
  },
});
