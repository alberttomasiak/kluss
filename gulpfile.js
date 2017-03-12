var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css'); // minify css files
var concatCss = require('gulp-concat-css'); // merge css files together
var sass = require('gulp-sass'); // sass for gulp
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin'); // image optimization
var pngquant = require('imagemin-pngquant'); // bundled with imagemin
var uglify = require('gulp-uglify'); // minify javascript files
//var livereload = livereload = require('gulp-livereload'); // live reload with chrome extension

gulp.task('default', ['css-minify', 'image-minify', 'compress-js', 'sass']);

gulp.task('party', function(){
		console.log("Making my way downtown, walking fast, faces pass, and I'm home-bound.");
		console.log("Staring blankly ahead, just making my way, making a way, through the crowd.");
		console.log("And I need you. And I miss you. And now I wonder....");
});

// master sass -> compress + minify & store elsewhere
gulp.task('sass', function(){
	return gulp.src('resources/assets/sass/app.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'})) // sass -> css
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('public/assets/css'));
		//.pipe(livereload());
});

gulp.task('css-minify', function(){
	return gulp.src('resources/assets/css/*')
		.pipe(sourcemaps.init())
		.pipe(cleanCSS()) // minify
		.pipe(sourcemaps.write('./maps'))
		.pipe(gulp.dest('public/assets/css'));
});

// image minify
gulp.task('image-minify', function(){
	return gulp.src('resources/assets/img/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest('public/assets/img'));
});

gulp.task('compress-js', function() {
	return gulp.src('resources/assets/js/*.js')
		.pipe(uglify())
		.pipe(gulp.dest('public/assets/js'));
});

// look for changes
gulp.task('watch', function(){
	//livereload.reload();
	gulp.watch('resources/assets/sass/**/*.scss', ['sass']);
	gulp.watch('resources/assets/img/*', ['image-minify']);
	gulp.watch('resources/assets/css/**/*.css', ['css-minify']);
	gulp.watch('resources/assets/js/*.js', ['compress-js']);
});

// run all tasks
//gulp.task('all', ['css-minify', 'image-minify', 'compress-js', 'sass']);
