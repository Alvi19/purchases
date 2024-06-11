module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "Figtree",
                    ...require("tailwindcss/defaultTheme").fontFamily.sans,
                ],
            },
        },
    },

    plugins: [require("daisyui"), require("@tailwindcss/forms")],
};
