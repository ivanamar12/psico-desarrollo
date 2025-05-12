const mix = require("laravel-mix");

mix
  .js("resources/js/especialistas.js", "public/js")
  .js("resources/js/registroespecialista.js", "public/js")
  .js("resources/js/telefonovalidacion.js", "public/js");

mix
  .js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.css", "public/css", [
    require("tailwindcss"),
    require("autoprefixer"),
  ]);
