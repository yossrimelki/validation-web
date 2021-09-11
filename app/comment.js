var a = 1;

function hide_show(i) {

    if (a == 0) {
        document.getElementById(i).style.display = "none";
        return a = 1;
    } else {
        document.getElementById(i).style.display = "block";
        return a = 0;
    }
}

var b = 1;

function hide_showt(j) {

    if (b == 0) {
        document.getElementById("edit" + j).style.display = "none ";
        return b = 1;
    } else {
        document.getElementById("edit" + j).style.display = "flex";
        return b = 0;
    }
}
$(document).ready(function() {

    $('.sendbtn').on('click', function() {
        var postid = $(this).data('id');

        $post = $(this);

        $.ajax({
            url: 'home.php',
            type: 'POST',
            data: {
                'comments': 1,
                'postid': postid
            },
            success: function(response) {
                $post.parent().find('span.metacomment').text(response + "  Comments");


                document.querySelector('span').textContent = '*';

            }
        });

    });
});