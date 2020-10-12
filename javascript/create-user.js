$(document).ready(function () {

    $("#register_form").submit(function (e) {

        
        e.preventDefault();
        event.preventDefault()

        alert("Data");

        var form_data = $(this).serializeArray();
        var requestinfo=$(this);
        $.ajax({
            url: requestinfo.attr("action"),
            type: requestinfo.attr("method"),
            data: form_data,
            success: function (response) {

                alert(response);

                window.location.href="http://localhost/Sheila/sheila/client-homepage.html";

            },
            error: function (response) {
                alert('ajax failed');
                // ajax error callback
            },

        });

    });

});