var gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');

//вспомогательные переменные 
var webDir = 'frontend/web';
var sassDir = webDir + '/scss';
var targetCssDir = webDir + '/css';

//    :nested
//    :compact
//    :expanded
//    :compressed
var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed'
};

//gulp.task('hello', function() {
//  console.log('Hello Zell');
//});


// подключаем gulp-sass
var sass = require('gulp-sass');

gulp.task('sass', function(){
  return gulp
    .src(sassDir + '/**/*.scss')// Получаем все файлы с окончанием .scss в папке app/scss и дочерних директориях
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError)) // Конвертируем Sass в CSS с помощью gulp-sass
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest(targetCssDir))
});

//запуск из консоли - gulp watch
gulp.task('watch', function(){
  gulp.watch('frontend/web/scss/**/*.scss', ['sass']); //следить за всеми Sass файлами и запускать задачу sass при любом изменении
  // другие ресурсы
})