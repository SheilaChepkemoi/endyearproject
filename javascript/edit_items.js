$(document).ready(function () {


    var item_id=sessionStorage.getItem("itemid");


    $('#edit_name').submit(function (event) {
        event.preventDefault();
        var requestinfo=$(this);

        var name=$("#name").val();


        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: {
                    "item_id":item_id,
                    "name":name,
                },
                success: function (response) {

                    $parse=JSON.parse(response);

                    swal($parse.message);

                    // ajax success callback
                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });


    $('#edit_price').submit(function (event) {
        event.preventDefault();
        var requestinfo=$(this);

        var price=$("#price").val();


        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: {
                    "item_id":item_id,
                    "price":price,
                },
                success: function (response) {

                    $parse=JSON.parse(response);

                    swal($parse.message);


                    // ajax success callback
                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });

    $('#edit_stock').submit(function (event) {
        event.preventDefault();
        var requestinfo=$(this);

        var price=$("#stock").val();


        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: {
                    "item_id":item_id,
                    "stock":price,
                },
                success: function (response) {

                    $parse=JSON.parse(response);


                    swal($parse.message);

                    // ajax success callback
                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });
    $('#edit_description').submit(function (event) {
        event.preventDefault();
        var requestinfo=$(this);

        var description=$("#description").val();


        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: {
                    "item_id":item_id,
                    "description":description,
                },
                success: function (response) {

                    $parse=JSON.parse(response);


                    swal($parse.message);

                    // ajax success callback
                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });

    $('#edit_image').submit(function (event) {
        event.preventDefault();
        var requestinfo=$(this);

        $("#item_id").val( sessionStorage.getItem("itemid"));


        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (response) {

                    $parse=JSON.parse(response);


                    swal($parse.message);
                    // ajax success callback
                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });



});