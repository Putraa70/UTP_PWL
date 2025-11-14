import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  server: {
    host: 'himakom-manager.test',   // sesuaikan dengan domain kamu
    hmr:  { host: 'himakom-manager.test' }, // penting biar CSS kebaca
    port: 5173,
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
})
