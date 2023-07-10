$(document).ready(function() {
    $("#response-select").on('change', function() {
        let value = $(this).val();
       // alert(value);

        $.ajax({
            url: "../php/fetchData/fetch-responses.php",
            type: "POST",
            data: "request=" + value,
            success: function(data) {
                $(".list").html(data);
            }

        });
    })
});