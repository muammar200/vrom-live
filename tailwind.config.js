import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        fontFamily: {
			poppins: "Poppins, sans-serif",
		},
		container: {
			center: true,
			padding: {
				DEFAULT: "1rem",
				lg: "75px",
				xl: "100px",
			},
		},
		extend: {
			colors: {
				primary: "#4743FB",
				secondary: "#9D9DBC",
				dark: "#0D0C41",
				grey: "#D8D8E4",
				darkGrey: "#F5F6F6",
				subtlePars: "#B0AED6",
			},
		},
    },

    plugins: [forms, typography],
};
