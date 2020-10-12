$(document).ready(function () {


    $("#create_item").submit(function (event) {

        event.preventDefault();

        swal({
            title: "Are you sure?",
            text: "Confirm to add item",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var form_data = $(this).serializeArray();
                    var requestinfo=$(this);


                    $.ajax(
                        {
                            url: requestinfo.attr("action"),
                            type: requestinfo.attr("method"),
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData:false,
                            success: function (response) {

                                swal(response);

                                window.location.href="http://localhost/Sheila/manage_items.html";

                            },
                            error: function (response) {
                                alert('ajax failed');
                                // ajax error callback
                            },

                        }
                    );
                } else {
                    swal("Cancelled");
                }
            });


    });


});