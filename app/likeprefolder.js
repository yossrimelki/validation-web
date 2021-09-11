$(document).ready(function() {

    $('.like').on('click', function() {
        var postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: '../home.php',
            type: 'post',
            data: {
                'liked': 1,
                'postid': postid
            },
            success: function(response) {
                $post.parent().find('span.metaInfo').text(response + "  likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');

                document.querySelector('span').textContent = '*';

            }
        });
    });


    $('.unlike').on('click', function() {
        var postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: '../home.php',
            type: 'post',
            data: {
                'unliked': 1,
                'postid': postid
            },
            success: function(response) {
                $post.parent().find('span.metaInfo').text(response + "  likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');

                document.querySelector('span').textContent = '  ';

            }
        });
    });
});