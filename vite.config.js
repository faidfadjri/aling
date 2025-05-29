// vite.config.js

const { defineConfig } = require('vite');

module.exports = defineConfig(async () => {
  const laravel = (await import('laravel-vite-plugin')).default;

  return {
    server: {
      host: 'localhost',
      port: 5173,
      hmr: {
        host: 'localhost',
      },
    },
    plugins: [
      laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: true,
      }),
    ],
  };
});
