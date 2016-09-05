<?php
//@app: Your application root directory (either frontend or backend or console depending on where you access it from)
//@vendor: Your vendor directory on your root app install directory
//@runtime: Your application files runtime/cache storage folder
//@web: Your application base url path
//@webroot: Your application web root
//@tests: Your console tests directory
//@common: Alias for your common root folder on your root app install directory
//@frontend: Alias for your frontend root folder on your root app install directory
//@backend: Alias for your backend root folder on your root app install directory
//@console: Alias for your console root folder on your root app install directory
return [
    
    '@images-web' =>  $baseUrl.'/images',//для веб
    '@images-path' => '@frontend/web/images',//для файловой системы
    
    '@photogalery-web' =>  $baseUrl.'/images/photogalery',//для веб
    '@photogalery-path' => '@frontend/web/images/photogalery',//для файловой системы
    
    '@avatar-img-web' =>  $baseUrl.'/images/avatar',//для веб
    '@avatar-img-path' => '@frontend/web/images/avatar',//для файловой системы
];

