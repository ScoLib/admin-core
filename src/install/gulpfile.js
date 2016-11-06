const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var jsuglify = require('gulp-uglify');
var rename = require('gulp-rename');

var node_path = 'node_modules';

var paths = {
    'jquery': node_path + '/jquery',
    'bootstrap': node_path + '/bootstrap',
    'icheck': node_path + '/icheck',
    'jqueryvalidation': node_path + '/jquery-validation',
    'fontawesome': node_path + '/font-awesome',
};

elixir.config.sourcemaps = false;
elixir.config.versioning = {
    buildFolder: ''
};

elixir.extend('jsminify', function () {
    new elixir.Task('jsminify', function () {
        return gulp.src(['public/js/admin.js', paths.jqueryvalidation + '/dist/jquery.validate.js'])
            .pipe(rename({suffix: '.min'}))
            .pipe(jsuglify())
            .pipe(gulp.dest('public/js'));
    });
});

elixir(mix => {
    mix.less([
        'AdminLTE/AdminLTE.less', 'AdminLTE/skins/skin-green.less'
    ], 'public/css/admin.css')
        .copy(paths.jquery + '/dist/jquery.min.js', 'public/js/jquery.min.js')
        // .copy(paths.jqueryvalidation + '/dist/jquery.validate.js', 'public/js/jquery.validate.js')

        .copy(paths.icheck + '/icheck.min.js', 'public/icheck/icheck.min.js')
        .copy(paths.icheck + '/skins', 'public/icheck/skins')

        .copy(paths.bootstrap + '/dist/js/bootstrap.min.js', 'public/bootstrap/js/bootstrap.min.js')
        .copy(paths.bootstrap + '/dist/fonts', 'public/bootstrap/fonts')
        .copy(paths.bootstrap + '/dist/css/bootstrap.min.css', 'public/bootstrap/css/bootstrap.min.css')

        .copy(paths.fontawesome + '/fonts', 'public/font-awesome/fonts')
        .copy(paths.fontawesome + '/css/font-awesome.min.css', 'public/font-awesome/css/font-awesome.min.css')

        .copy('resources/assets/fonts', 'public/fonts')
        .copy('resources/assets/js/admin', 'public/js/admin')
        .webpack('admin.js')
        .jsminify()
        // .webpack('jquery.validate.js', 'public/js/jquery.validate.min.js', 'public/js')
        .version(['css/admin.css', 'js/admin.min.js'])
        
        ;
});
