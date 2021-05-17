var gulp = require('gulp'),
    browserSync = require('browser-sync'),
    reload = browserSync.reload,
    autoprefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    minifyCSS = require('gulp-minify-css'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    uglify = require('gulp-uglify'),
    sassGlob = require('gulp-sass-glob')

gulp.task('styles', function () {
    return gulp.src([
        './rdm-rsm-parent/assets/styles/style.scss'
    ])
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(sourcemaps.init())
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(minifyCSS())
        .pipe(autoprefixer('last 5 version'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./rdm-rsm-parent/assets'))
})

gulp.task('styles-dev', function () {
    return gulp.src([
        './rdm-rsm-parent/assets/styles/style.scss'
    ])
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        //.pipe(sourcemaps.init())
        .pipe(sassGlob())
        .pipe(sass())
        //.pipe(minifyCSS())
        .pipe(autoprefixer('last 5 version'))
        //.pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./rdm-rsm-parent/assets'))
        .pipe(reload({stream: true}))
})

gulp.task('scripts', function () {
    return gulp.src([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/jquery.scrollto/jquery.scrollTo.js',
        './node_modules/mustache/mustache.js',
        './node_modules/@brightcove/player-loader/dist/brightcove-player-loader.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './rdm-rsm-parent/assets/scripts/scripts.js',
        './rdm-rsm-parent/assets/scripts/lib/*.js'
    ])
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(concat('./parent.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./rdm-rsm-parent/assets'))
})

gulp.task('scripts-dev', function () {
    return gulp.src([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/jquery.scrollto/jquery.scrollTo.js',
        './node_modules/mustache/mustache.js',
        './node_modules/@brightcove/player-loader/dist/brightcove-player-loader.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './rdm-rsm-parent/assets/scripts/scripts.js',
        './rdm-rsm-parent/assets/scripts/lib/*.js'
    ])
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(concat('./parent.min.js'))
        // .pipe(uglify())
        .pipe(gulp.dest('./rdm-rsm-parent/assets'))
        .pipe(reload({stream: true}))
})

//******************************************************************************
//* rogerssportsandmedia.com
//******************************************************************************

gulp.task('rsm-styles', function () {
    return gulp.src('./rogerssportsandmedia.com/assets/styles/*.scss')
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(sourcemaps.init())
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(minifyCSS())
        .pipe(autoprefixer('last 5 version'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./rogerssportsandmedia.com/assets'))
})

gulp.task('rsm-styles-dev', function () {
    return gulp.src('./rogerssportsandmedia.com/assets/styles/*.scss')
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(autoprefixer('last 5 version'))
        .pipe(gulp.dest('./rogerssportsandmedia.com/assets'))
        .pipe(reload({stream: true}))
})

gulp.task('rsm-scripts', function () {
    return gulp.src('./rogerssportsandmedia.com/assets/scripts/scripts.js')
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(concat('./rsm.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./rogerssportsandmedia.com/assets'))
})

gulp.task('rsm-scripts-dev', function () {
    return gulp.src('./rogerssportsandmedia.com/assets/scripts/scripts.js')
        .pipe(plumber({
            errorHandler: notify.onError('Error: <%= error.message %>')
        }))
        .pipe(concat('./rsm.min.js'))
        .pipe(gulp.dest('./rogerssportsandmedia.com/assets'))
        .pipe(reload({stream: true}))
})


//******************************************************************************
// configure which files to watch and what tasks to use on file changes
//******************************************************************************

gulp.task('watch', function () {
    gulp.watch(["./rdm-rsm-parent/assets/styles/**/*.scss", "./node_modules/bootstrap/scss/**/*.scss"], gulp.parallel(["styles-dev"]))
    gulp.watch("./rdm-rsm-parent/assets/scripts/**/*.js", gulp.parallel(["scripts-dev"]))
    gulp.watch("./rogerssportsandmedia.com/assets/styles/**/*.scss", gulp.parallel(["rsm-styles-dev"]))
    gulp.watch("./rogerssportsandmedia.com/assets/scripts/**/*.js", gulp.parallel(["rsm-scripts-dev"]))
})

gulp.task('default', gulp.series(
    'styles-dev',
    'scripts-dev',
    'rsm-styles-dev',
    'rsm-scripts-dev',
    'watch'
));

gulp.task('release', gulp.series(
    'styles',
    'scripts',
    'rsm-styles',
    'rsm-scripts',
));

