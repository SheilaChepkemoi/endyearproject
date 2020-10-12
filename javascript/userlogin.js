
$(document).ready(function () {

    $('#login_form').submit(function (event) {
        event.preventDefault()
        var form_data = $(this).serializeArray();
        var requestinfo=$(this);

        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: form_data,
                success: function (response) {

                    $parse=JSON.parse(response);



                    if ($parse.length > 0 ){


                        $.each($parse,function (key,value) {

                            alert(value.admin_name);

                            sessionStorage.setItem("admin_id",value.admin_id);
                            sessionStorage.setItem("admin_email",value.admin_email);
                            sessionStorage.setItem("admin_name",value.admin_name);



                        });

                        window.location.href="http://localhost/Sheila/manage_items.html";

                    }
                    else{

                        swal("Wrong user name or password");
                    }


                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });

})

