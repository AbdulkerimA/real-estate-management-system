import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import fs from 'fs';
import path from 'path';

// Helper to automatically include all .js and .css files
function getAllFiles(dir, ext, fileList = []) {
    const files = fs.readdirSync(dir);
    files.forEach(file => {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            getAllFiles(fullPath, ext, fileList);
        } else if (file.endsWith(ext)) {
            fileList.push(fullPath.replace(/\\/g, '/'));
        }
    });
    return fileList;
}

const jsFiles = getAllFiles('resources/js', '.js');
const cssFiles = getAllFiles('resources/css', '.css');


export default defineConfig({
    plugins: [
        laravel({
            input: [
                 ...jsFiles,
                ...cssFiles,
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
