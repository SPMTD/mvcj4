$(document).ready(function() {
    $('.posts').on('click', '.post .interaction #edit', function(event) {
        var postTitle = $(this).closest('.post').find('p:eq(0)').text();
        console.log(postTitle);
        event.preventDefault();
        $('#post-title').val(postTitle);
    });
});

