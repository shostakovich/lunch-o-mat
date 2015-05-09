var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.copy(
            'vendor/bower_components/bootstrap/dist/css/bootstrap.css',
            'resources/assets/sass/vendor/bootstrap.scss')
       .sass('app.scss').phpUnit();
});
