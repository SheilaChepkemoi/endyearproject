function register() {

    event.preventDefault();

    let name, email, phone_number, password, confirm_password;

    name = $('.client-name-edit').val();
    email = $('.email-edit').val();
    phone_number = $('.phone-number-edit').val();
    password = $('.password-edit').val();
    confirm_password = $('.confirm-password-edit').val();

    //check if passwords match
    if(password !== confirm_password){
        alert("Passwords do not match");
        return;
    }

    let data = {
        jsonrpc: "2.0",
        method: "Client.register",
        params: {
            name: name,
            email: email,
            phone_number: phone_number,
            password: password
        },
        id: Math.floor(Math.random() * 100)
    };

    $.ajax({
        type: "POST",
        url: "./api/index.php",
        data: JSON.stringify(data),

        success: function (response) {

            let result = response.result;

            if(result.status === "SUCCESS"){
                alert("SUCCESS: " + result.response_message);
                window.location.replace("login.html");
            }else {
                alert("FAILED: " + result.response_message);
                console.log(result.response_data);
            }
        }
    });

}

function login() {

    event.preventDefault();

    let email, password;

    email = $('.email_edit').val();
    password = $('.password_edit').val();

    let data = {
        jsonrpc: "2.0",
        method: "Authenticator.authenticate",
        params: {
            email: email,
            password: password
        },
        id: Math.floor(Math.random() * 100)
    };

    $.ajax({
        type: "POST",
        url: "./api/index.php",
        data: JSON.stringify(data),

        success: function (response) {

            let result = response.result;

            if(result.status === "SUCCESS"){
                alert("SUCCESS: " + result.response_message);
                window.location.replace("client-homepage.html");
            }else {
                alert("FAILED: " + result.response_message);
                console.log(result.response_data);
            }

        }

    });

}

function getItems(type) {

    let data = {
        jsonrpc: "2.0",
        method: "Item.getItems",
        params: {
            type: type
        },
        id: Math.floor(Math.random() * 100)
    };

    $.ajax({
        type: "POST",
        url: "./api/index.php",
        data: JSON.stringify(data),

        success: function (response) {

            let result = response.result;

            if(result.status === "SUCCESS"){
                let items = result.response_data;

                let item;

                for (let i=0; i<items.length; i++){

                    item = items[i];

                    $('#items-div').append(
                        '<div class="col-lg-4 col-sm-6">\n' +
                        '\t<div class="product-item">\n' +
                        '\t\t<div class="pi-pic">\t\t\t\n' +
                        '\t\t\t<img src="images/' + item.image + '" alt="">\n' +
                        '\t\t\t<div class="pi-links">\n' +
                        '\t\t\t\t<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>\t\t\t\t\n' +
                        '\t\t\t</div>\n' +
                        '\t\t</div>\n' +
                        '\t\t<div class="pi-text">\n' +
                        '\t\t\t<h6>Ksh ' + item.item_price + '</h6>\n' +
                        '\t\t\t<a href="#">' + item.item_name + '</a>\n' +
                        '\t\t</div>\n' +
                        '\t</div>\n' +
                        '</div>'
                    );

                    switch (item.item_type) {
                        case 'tent':
                            $('#tents-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'chair':
                            $('#chairs-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'table':
                            $('#tables-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'stemware_barware':
                            $('#stemware-barware-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'cutlery':
                            $('#cutlery-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'cups':
                            $('#cups-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'plates':
                            $('#plates-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                        case 'mobile_toilet':
                            $('#mobile-toilets-sub-menu').append('<li><a href="#">' + item.item_name + '<span>(' + item.amount_in_stock + ')</span></a></li>');
                            break;
                    }
                }

            }else {
                alert("FAILED: " + result.response_message);
                console.log(result.response_data);
            }
        }
    });

}
