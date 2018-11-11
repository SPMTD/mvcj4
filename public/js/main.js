var postId = 0;
var postTitleElement = null;

$(document).ready(function() {
    $('.posts').on('click', '.post .interaction #edit', function(event) {
        postTitleElement = $(this).closest('.post').find('p:eq(0)');
        var postTitle = postTitleElement.text();
        postId = $(this).parents('article.post').data('postid');
        console.log(postTitle);
        event.preventDefault();
        $('#post-title').val(postTitle);
    });

    $('#modal-save').on('click', function() {
        // console.log();
        $.ajax({
            method: 'POST',
            url: urlEdit,
            data: { title: $('#post-title').val(), postId: postId, _token: token }
        })
            .done(function(msg) {
                $(postTitleElement).text(msg['new_title']);
                $('#edit-modal').modal('hide');
                $('.modal-backdrop').remove();
            });
    });

    $('.like').on('click', function(event) {
        event.preventDefault();
        var isLike = event.target.previousElementSibling == null;
        postId = $(this).parents('article.post').data('postid');
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: {isLike: isLike, postId: postId, _token: token}
        })
            .done(function(){
                event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'like' : event.target.innerText == 'Dislike' ? 'You Dislike this post' : 'Dislike';
                if(isLike) {
                    event.target.nextElementSibling.innerText = 'Dislike'
                } else {
                    event.target.previousElementSibling.innerText = 'Like';
                }
            });
    });


    $('.on-off').on('click', function(event) {
        event.preventDefault();

        $.ajax({
            method: 'POST',
            
        })
        
    })
});




