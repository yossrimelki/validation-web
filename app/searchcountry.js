$(document).ready(function() {
    $("#search").keyup(function() {
        var searchText = $(this).val();
        if (searchText != '') {
            $.ajax({
                url: '../tm/classes/searchcountry.php',
                method: 'POST',
                data: { query: searchText },

                success: function(response) {
                    $("#show-list").html(response);
                }
            });
        } else {
            $("#show-list").html('');
        }
    });
    $(document).on('click', 'p', function() {
        $("#search").val($(this).text());
        $("#show-list").html('');
    });
    $(document).on('click', 'a.list-group-item ', function() {
        $("#search").val($(this).text());
        $("#show-list").html('');
        var searchText = $(this).text();
        $.ajax({
            url: '../tm/classes/searchcountry.php',
            method: 'POST',
            data: { addcountry: searchText }



        });
    });
});