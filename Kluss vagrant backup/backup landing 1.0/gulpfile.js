var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css'); // minify css files
var concatCss = require('gulp-concat-css'); // merge css files together
var sass = require('gulp-sass'); // sass for gulp
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin'); // image optimization
var pngquant = require('imagemin-pngquant'); // bundled with imagemin
var uglify = require('gulp-uglify'); // minify javascript files

gulp.task('default', function(){
	console.log("Hey Nico, you wanna go bowling?");
});

// master sass -> compress + minify & store elsewhere
gulp.task('sass', function(){
	return gulp.src('assets/sass/style.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'})) // sass -> css
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('build/css'));
});

gulp.task('css-minify', function(){
	return gulp.src('assets/css/*')
		.pipe(sourcemaps.init())
		.pipe(cleanCSS()) // minify
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('build/css'));
});

// image minify
gulp.task('image-minify', function(){
	return gulp.src('assets/img/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest('build/img'));
});

gulp.task('compress-js', function() {
	return gulp.src('assets/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('build/js'));
});

// look for changes
gulp.task('watch', function(){
	gulp.watch('assets/sass/**/*.scss', ['sass']);
	gulp.watch('assets/img/*', ['image-minify']);
	gulp.watch('assets/css/*', ['css-minify']);
	gulp.watch('assets/js/*', ['compress-js']);
});

// run all tasks
gulp.task('all', ['sass', 'css-minify', 'image-minify', 'compress-js']);
