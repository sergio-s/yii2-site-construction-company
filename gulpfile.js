//Подключаемые плагины
var gulp = require('gulp');
var sass = require('gulp-sass');// подключаем gulp-sass
var sourcemaps = require('gulp-sourcemaps');//плагин генерации карты ресурсов
var concat = require('gulp-concat');//конкатинация файлов
var minifyCss = require('gulp-clean-css');//минификация css
var autoprefixer = require('gulp-autoprefixer');//префиксы обеспечивают поддержку браузерами CSS3(пример - -webkit, -ms, -o, -moz)
var rename = require('gulp-rename');
var notify = require("gulp-notify");
var imagemin = require('gulp-imagemin');//компрессинг картинок
var spritesmith = require('gulp.spritesmith');//генерация спрайтов
var runSequence = require('run-sequence');//для последовательного выполнения задач, перечисленных в task массиве



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
    outputStyle: 'expanded'
};


//------------------------------------------------------------------------------
// компиляция sass
//------------------------------------------------------------------------------
gulp.task('compileSass', function(){
  return gulp
    .src(sassDir + '/**/*.scss')// Получаем все файлы с окончанием .scss в папке app/scss и дочерних директориях
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError)) // Конвертируем Sass в CSS с помощью gulp-sass
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest(targetCssDir))
    .pipe(notify("Sass was compiled to css!"));
});


//------------------------------------------------------------------------------
//Добавление префиксов для css3
//------------------------------------------------------------------------------
//Перезаписывает файлы в папке css, добавляя префиксы css3 где нет. Также запускается при compileSass
//gulp.task('autoPrefixer', ['compileSass'], function(){
gulp.task('autoPrefixer', function(){
    return gulp
        .src(targetCssDir + '/*.css', {base: './'})
        .pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['last 3 versions', '> 5%'],
            cascade: false
        }))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./'));//перезапись файлов
});


//gulp.task('concat-css', function() {
//    return gulp.src(
//        [
//            targetCssDir + '/reset.css',
//            targetCssDir + '/grid.css',
//            targetCssDir + '/style.css',
//            targetCssDir + '/gb.css'
//        ]
//    )
//        .pipe(concat('app.css'))
//        .pipe(gulp.dest(targetCssDir));
//});


//------------------------------------------------------------------------------
//Минификация css
//------------------------------------------------------------------------------
gulp.task('minify-css', function(){
    return gulp
        .src(targetCssDir + '/*.css')
        .pipe(minifyCss({debug: false}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(targetCssDir + '/min'));
        //.pipe(notify("Css filef was minimized and saved!"));
});


//------------------------------------------------------------------------------
//оптимизация картинок css
//------------------------------------------------------------------------------
gulp.task('compressImg', function() {
    return gulp
        .src(targetCssDir + '/img/*')
        .pipe(imagemin({
          progressive: true
        }))
        .pipe(gulp.dest(targetCssDir + '/img/'));
});



//--------------------------------------------------------------------------------
//                  генерация спрайтов
//--------------------------------------------------------------------------------

gulp.task('spriteIco', function () {
  var spriteData = gulp.src(targetCssDir + '/icons/ico_1/*')
        .pipe(spritesmith({
            imgName: 'sprite_ico_1.png',
            cssName: 'sprite_ico_1.scss',
//            cssFormat: 'scss',
            padding: 1,
            algorithm: 'top-down'
            
        }));
    spriteData.img
//        .pipe(imagemin())
        .pipe(gulp.dest(targetCssDir + '/icons/sprite-ico_1/'));
    //сохраняем стили
    spriteData.css
        .pipe(gulp.dest(targetCssDir + '/icons/sprite-ico_1/'));
});

gulp.task('compressIco',['spriteIco'], function() {
    return gulp
        .src(targetCssDir + '/icons/sprite-ico_1/*.png')
        .pipe(imagemin({
          progressive: true
        }))
        .pipe(gulp.dest(targetCssDir + '/icons/sprite-ico_1/'));
});

gulp.task('startCompresIco', ['spriteIco', 'compressIco']);
//gulp.task('startCompresIco', function(callback) {
//  runSequence('spriteIco', 'compressIco',callback);
//});

/////////////////////////////////////////////////////////////////////////////////
//                  генерация спрайтов
////////////////////////////////////////////////////////////////////////////////


//------------------------------------------------------------------------------
//Наблюдение за файлами. (запуск из консоли - gulp watch)
//------------------------------------------------------------------------------
gulp.task('watch', function(){
  gulp.watch(sassDir + '/**/*.scss', ['compileSass']); //следить за всеми Sass файлами и запускать задачу sass при любом изменении
  gulp.watch(targetCssDir + '/*.css', ['autoPrefixer']);
  gulp.watch(targetCssDir + '/*.css', ['minify-css']);
  gulp.watch(targetCssDir + '/img/*', ['compressImg']);//при добавлении картинок в папку, они будут оптимизированы
});