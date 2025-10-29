import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
<<<<<<< HEAD
import tailwindcss from '@tailwindcss/vite';
=======
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
<<<<<<< HEAD
        tailwindcss(),
=======
>>>>>>> f9bcb00 (Creando el modelo, vista, controlador de el sistema Login de usuarios)
    ],
});
