/* REQUIRE
   =========================================*/
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var browserSync = require('browser-sync').create();
var gcmq = require('gulp-group-css-media-queries');

/* TASKS
   =========================================*/
var onError = function(err){
    console.log(err);
}
gulp.task('sass', function() {
    return gulp.src('scss/style.scss')
        .pipe($.plumber({errorHandler: onError}))
        .pipe($.sass().on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers : ['last 2 versions'],
            cascade : false
        }))
    .pipe(gcmq())
        .pipe(gulp.dest('.'))
        .pipe($.cssmin())
        .pipe($.rename({suffix: '.min'}))
        .pipe(gulp.dest('.'))
        .pipe(browserSync.stream());
})

// JS
// tache a ajouter par la suite

/* WATCH
   =========================================*/
gulp.task('default', ['sass'], function() {
    browserSync.init({
        //notify: false,
        proxy: "localhost/framework-mvc/"
    });
    gulp.watch('scss/**/*.scss', ['sass']).on('change', function(event) {
        console.log('le fichier '+ event.path +' a été modifié')
    });
    gulp.watch('**/*.php').on('change', browserSync.reload).on('change', function(event) {
        console.log('le fichier '+ event.path +' a été modifié' );
    });
})
