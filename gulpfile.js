var gulp = require('gulp');
var postcss = require('gulp-postcss');
var sass	=	require('gulp-sass');
var autoprefixer = require('autoprefixer');
var rucksack	=	require('rucksack-css');
//var cssnano	= require('gulp-cssnano');


gulp.task('css', function () {
  var processors = [
    autoprefixer({browsers: ['last 5 version']}),
    rucksack
  //cssnano
];
  return gulp.src('./postcss/*.css')
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    //.pipe(cssnano())
    .pipe(gulp.dest(''));
});