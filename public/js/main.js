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
            url: url,
            data: { title: $('#post-title').val(), postId: postId, _token: token }
        })
            .done(function(msg) {
                $(postTitleElement).text(msg['new_title']);
                $('#edit-modal').modal('hide');
                $('.modal-backdrop').remove();
            });
    });
});




