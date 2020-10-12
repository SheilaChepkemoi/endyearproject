
$(document).ready(function () {

    $('#login_form').submit(function (event) {
        event.preventDefault();
       
        var form_data = $(this).serializeArray();
        var requestinfo=$(this);

        $.ajax(
            {
                url: requestinfo.attr("action"),
                type: requestinfo.attr("method"),
                data: form_data,
                success: function (response) {

                    $parse=JSON.parse(response);

                   

                    $.each($parse,function (key,value) {
                       

                        sessionStorage.setItem("client_id",value.client_id);

                        sessionStorage.setItem("logged_in_client_name",value.client_name);

                        sessionStorage.setItem("logged_in_client_email",value.client_email);


                    });

                    if ($parse.length > 0){
                        window.location.href="http://localhost/Sheila/sheila/client-homepage.html";
                    }

                    else{

                        swal("Wrong User name or password");


                    }





                    // ajax success callback
                },
                error: function (response) {
                    alert('ajax failed');
                    // ajax error callback
                },
            }

        );

    });

})

