jQuery(document).ready(function($){

//ОБРАБОТКА АДМИНИСТРАТИВНЫХ КНОПОК
//заполнение скрытого поля при ответе на коментарий
//при использовании pjax нужно искать ,начиная с body
        $('body').on( "click",'a.message-reply', function(event){


            event.preventDefault();
            var comment = $(this).closest('.message-content');

            var commentReplyLink = $(this).closest('.message-reply');
            var commentNoReplyLink = comment.find('.comment-no-reply');

            var id = commentReplyLink.data('comment-id');



            $('#comment-form').detach().appendTo(comment);
            $('#gbHiddenInputParentId').attr('value', id);

            $('.comment-reply').show();
            $('.comment-no-reply').hide();


            commentReplyLink.hide();
            commentNoReplyLink.show();

            //alert("Код" + id );
        });

        //при использовании pjax нужно искать ,начиная с body
        $('body').on( "click",'a.comment-no-reply', function(event){

            event.preventDefault();
            var commentNoReplyLink = $(this).closest('.comment-no-reply');
            var commentsList = $('.comments-list');

            $('#comment-form').detach().appendTo(commentsList);
            $('#hiddenInputParentId').attr('value', null);

            commentNoReplyLink.siblings('.comment-reply').show();
            commentNoReplyLink.hide();


            //alert("Код" + id );
        });


});

//$(document).on('click', '.reply-link', function() {
//    var comment = $(this).closest('.comment');
//    $('#comment-form').detach().appendTo(comment);
//    $('#comment-parent_id').val(comment.data('id'));
//});