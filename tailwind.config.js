import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import aspectRatio from "@tailwindcss/aspect-ratio";
import generated_colors from "./.generated_colors";

function generateColors() {
    const colors = {
        transparent: "transparent",
        current: "currentColor",
        success: "rgb(139, 195, 74)",
        danger: {
            DEFAULT: "#f43f5e",
            light: "#fb7185",
            hover: "#e11d48",
        },
    };
    Object.keys(generated_colors).forEach((key) => {
        const color = {
            DEFAULT: `var(--color-${key})`,
            light: `var(--color-${key}-light)`,
            hover: `var(--color-${key}-hover)`,
        };
        colors[key] = color;
    });
    return colors;
}
/** @type {import('tailwindcss').Config} */

export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            screens: {
                320: { max: "424px" },
                576: { max: "575px" },
                768: { max: "767px" },
                1024: { max: "1023px" },
                1250: { max: "1249px" },
                1440: { max: "1439px" },
                1600: { max: "1599px" },
                1920: { max: "1919px" },
                "min-320": { min: "320px" },
                "min-576": { min: "576px" },
                "min-768": { min: "768px" },
                "min-1024": { min: "1024px" },
                "min-1250": { min: "1250px" },
                "min-1440": { min: "1440px" },
                "min-1600": { min: "1600px" },
                "min-1920": { min: "1920px" },
            },
            colors: generateColors(),
            container: {
                screens: {
                    sm: "600px",
                    md: "728px",
                    lg: "984px",
                    xl: "984px",
                    "2xl": "1240px",
                },
            },
            aspectRatio: {
                auto: "auto",
                square: "1 / 1",
                video: "16 / 9",
                golden: "1.6 / 1", //for golden ration e.g (aspect-golden)
                "golden-portrait": "1 / 1.6",
                1: "1",
                1.6: "1.6", //for golden ration e.g (aspect-w-1.6 aspect-h-1)
                2: "2",
                3: "3",
                4: "4",
                5: "5",
                6: "6",
                7: "7",
                8: "8",
                9: "9",
                10: "10",
                11: "11",
                12: "12",
                13: "13",
                14: "14",
                15: "15",
                16: "16",
            },
        },
    },

    plugins: [forms, aspectRatio, require("flowbite/plugin")],
};
