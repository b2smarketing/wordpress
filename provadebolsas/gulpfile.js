var gulp         = require('gulp');
var sass         = require('gulp-sass');
var browserSync  = require('browser-sync').create();
var uglify       = require('gulp-uglify');
var pipeline     = require('readable-stream').pipeline;
var postcss      = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');

// Task de auto reload
gulp.task('serve', ['sass'], function() {

    browserSync.init({
        proxy: "localhost/provadebolsas2/index.php"
    });

    // LP
    gulp.watch("assets/scss/**/*.scss", ['sass']);
    gulp.watch("assets/js/*.js", ['compress']);
    gulp.watch("**/*.php").on('change', browserSync.reload);
});

gulp.task('sass', function () {
    return gulp.src('assets/scss/style.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'normal'}).on('error', sass.logError))
        .pipe(postcss([ autoprefixer({
            browsers: ['> 1%', 'last 3 versions', 'Firefox >= 20', 'iOS >=7']
        }) ]))
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('assets/css/'))
        .pipe(browserSync.stream());
});

gulp.task('compress', function () {
    return pipeline(
        gulp.src('assets/js/*.js'),
        uglify(),
        gulp.dest('assets/js/compressed/'),
        browserSync.stream()
    );
});

gulp.task('default', ['serve']);