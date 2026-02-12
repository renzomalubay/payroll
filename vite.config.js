import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import { globSync } from "glob";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...globSync([
                    // compile all typescript and scss files in the resources/views directory
                    "resources/views/**/*.ts",
                    "resources/views/**/*.js",
                    "resources/views/**/*.scss",
                    "resources/ts/**/*.ts",
                    "resources/ts/**/*.js",
                    "resources/scss/**/*.scss",
                ]),
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            "@utils": "/resources/ts/utils",
            "@components": "/resources/ts/components",
        },
    },
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
