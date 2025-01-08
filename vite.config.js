import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx'
            ],
            refresh: true,
        }),
        react(),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        }
    },
    // build: {
    //     rollupOptions: {
    //       output: {
    //         manualChunks(id) {
    //           if (id.includes('node_modules')) {
    //             if (id.includes('pdfjs-dist')) return 'pdf-worker';
    //             if (id.includes('react-datepicker')) return 'datepicker';
    //             if (id.includes('sweetalert2')) return 'sweetalert';
    //           }
    //         },
    //       },
    //     },
    //   },
});
