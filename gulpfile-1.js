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
var targetCssDirMin = targetCssDir + '/min';//minimazed styles



//    :nested
//    :compact
//    :expanded
//    :compressed
var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'expanded'
};

// Bootstrap scss source
var bootstrapSassSource = {
    in: './node_modules/bootstrap-sass/'
};
var customBootstrapScssDir =  sassDir + '/my_bootstrap';
var customBootstrapScssFile = customBootstrapScssDir + '/custom_bootstrap3.scss';//мой кастомный файл scss (главный)
var dirCustomBootstrap = {
    nested: targetCssDir + '/custom_bootstrap3',
    min: targetCssDirMin + '/custom_bootstrap3'
    };

//------------------------------------------------------------------------------
//                  компиляция sass
//------------------------------------------------------------------------------
gulp.task('compileSass', function(){
  return gulp
    .src([
            sassDir + '/**/*.scss', 
            '!' + customBootstrapScssDir + '/'
        ])// Получаем все файлы с окончанием .scss в папке app/scss и дочерних директориях
    //.pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError)) // Конвертируем Sass в CSS с помощью gulp-sass
    //.pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest(targetCssDir))
    .pipe(notify("Sass was compiled to css!"));
});


//------------------------------------------------------------------------------
//                  компиляция custom twitter bootstrsp 3 из sass
//------------------------------------------------------------------------------
gulp.task('compileCustomBootstrap3', function(){
  return gulp
    .src(customBootstrapScssFile)
    //.pipe(sourcemaps.init())
    .pipe(sass({
                outputStyle: 'nested',
                precison: 3,
                errLogToConsole: true,
                includePaths: [
                    bootstrapSassSource.in + 'assets/stylesheets'//пути к ресурсам импорта прописанным в customBootstrapScssFile
//                    bootstrapSassSource.in + 'assets/fonts'
                ]
            })
    .on("error", sass.logError)) 
    //.pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest(dirCustomBootstrap.nested))
    .pipe(notify("Sass Bootstrap was compiled to css!"));
});


//------------------------------------------------------------------------------
//                  Добавление префиксов для css3
//------------------------------------------------------------------------------
//Перезаписывает файлы в папке css, добавляя префиксы css3 где нет. Также запускается при compileSass
//gulp.task('autoPrefixer', ['compileSass'], function(){
gulp.task('autoPrefixer', function(){
    return gulp
        .src([targetCssDir + '/*.css', dirCustomBootstrap.nested + '/*.css'], {base: './'})
        //.pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: ['last 3 versions', '> 5%'],
            cascade: false
        }))
        //.pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./'));//перезапись файлов
});

//------------------------------------------------------------------------------
//                  Минификация css
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
//                  Минификация custom twitter bootstrsp 3
//------------------------------------------------------------------------------
gulp.task('minifyCustomBootstrap', function(){
    return gulp
        .src(dirCustomBootstrap.nested + '/*.css')
        .pipe(minifyCss({debug: false}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dirCustomBootstrap.min));
        //.pipe(notify("Css filef was minimized and saved!"));
});

//------------------------------------------------------------------------------
//                  оптимизация картинок css
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
  gulp.watch(sassDir + '/**/*.scss', ['compileSass', 'compileCustomBootstrap3']); //следить за всеми Sass файлами и запускать задачу sass при любом изменении
  gulp.watch(targetCssDir + '/*.css', ['autoPrefixer']);
  gulp.watch(targetCssDir + '/*.css', ['minify-css', 'minifyCustomBootstrap']);
  gulp.watch(targetCssDir + '/img/*', ['compressImg']);//при добавлении картинок в папку, они будут оптимизированы
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