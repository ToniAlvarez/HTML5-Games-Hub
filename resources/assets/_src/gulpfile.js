var gulp = require('gulp');
var rename = require("gulp-rename");
var concat = require("gulp-concat");
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
var livereload = require('gulp-livereload');
var less = require('gulp-less');

var minifyCSS = require('gulp-minify-css');

//Configuration - Change me
var lessFiles = [
	{
		watch: 'bootstrap/less/bootstrap.less',
        watch2: 'bootstrap/less/**/*.less',
		output: './../css',
		name: 'bootstrap.css',
		nameMin: 'bootstrap.min.css'
	}
];

var jsFiles = [
	{
		watch: 'bootstrap/js/*.js',
		output: './../js/',
		name: 'bootstrap.js',
		nameMin: 'bootstrap.min.js'
	}
];

//END configuration


gulp.task('watch', function () {
        
	for (var i in lessFiles) {
		lessWatch(lessFiles[i]);
	}
 
	for (var j in jsFiles) {
		scriptWatch(jsFiles[j]);
	}
        
});

function lessWatch(lessData) {
	gulp.src(lessData.watch2)
	.pipe(watch(lessData.watch2, function() {
		gulp.src(lessData.watch)
		.pipe(less())
		.pipe(gulp.dest(lessData.output))
		.pipe(minifyCSS())
		.pipe(rename(lessData.nameMin))
		.pipe(gulp.dest(lessData.output));

	}));
}

function scriptWatch(jsData) {
	gulp.src(jsData.watch)
	.pipe(watch(jsData.watch, function() {
		gulp.src(jsData.watch)
		.pipe(concat(jsData.name))
		.pipe(gulp.dest(jsData.output))
		.pipe(uglify({outSourceMap: false}))
		.pipe(rename(jsData.nameMin))
		.pipe(gulp.dest(jsData.output));
	}));
}
 
gulp.task('default', ['watch']);