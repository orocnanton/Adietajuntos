var gulp = require('gulp');
var postcss = require('gulp-postcss');
var sass	=	require('gulp-sass');
var precss = require('precss');
var autoprefixer = require('autoprefixer');
var rucksack	=	require('rucksack-css');
var atImport = require('postcss-import');
var cssnext = require('cssnext');
//var cssnano	= require('gulp-cssnano');


gulp.task('css', function () {
  var processors = [
  atImport, 
  autoprefixer({browsers: ['last 5 version']}),
  rucksack,
  cssnext,
  sass,
  precss
  //cssnano
];
  return gulp.src('./postcss/*.css')
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    //.pipe(cssnano())
    .pipe(gulp.dest(''));
});