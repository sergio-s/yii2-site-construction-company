jQuery(document).ready(function(){

    jQuery("a.imgColorBox").colorbox({
        //title : Название фото,
        //width : 300,
        current: "Фото {current} из {total}",
    });
  
      
    var thumb = $('.hover-border');
    $('.bigger').css('opacity', '0');
    
    thumb.mouseover(function () {
        $(this).stop().animate({
            'borderColor': '#3583BF',
            'backgroundColor': "#DEF200",
        }, 500);
        
        $(this).find('.bigger').stop().animate({opacity:'1'},500);
    });
    thumb.mouseout(function () {
        $(this).stop().animate({
            'borderColor': '#e5e5e5',
            'backgroundColor': "#fff",
        }, 500);
        
        $(this).find('.bigger').stop().animate({opacity:'0'},500);
    });
                
 
});


