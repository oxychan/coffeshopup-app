<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" /> --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>


<body style="background-color: #d8d4dc;">
    @auth
    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">    
    @endauth
    <div class="py-12">
        <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg  md:max-w-5xl">
            <div class="md:flex ">
                <div class="w-full p-4 px-5 py-5">
                    <div class="md:grid md:grid-cols-12 gap-2 ">
                        <div class="col-span-12 p-5">
                            <button class="btn px-3 py-1"
                                style="color: #ffbe33; background-color:#202c34; border-radius: 15px; margin-left:85%;">
                                <a class="text-md font-medium mr-2" style="color: #ffbe33;"
                                    href="../../product/index.php">Kembali
                                </a>
                                <i class="fa fa-arrow-right text-sm pr-2"></i>
                            </button>
                            <h1 class="text-xl font-bold text-gray-800">Shopping Cart</h1>
                            <div class="flex justify-between items-center mt-6 pt-3">
                                <div class="flex  items-center">
                                </div>
                                <div class="flex justify-center items-center">
                                    <div class="pr-8 ">
                                        <span class="text-lg font-medium text-gray-800 font-bold">Subtotal</span>
                                    </div>
                                </div>
                            </div>

                            <div id="items">

                            </div>

                            <div>
                                <div class="flex justify-between items-center mt-3 pt-3">
                                    <button class="btn px-5 py-1 text-lg font-bold" name="bayarchart" id="order"
                                        style="color: #ffbe33; background-color:#ffbe33; color: #202c34; border-radius: 15px;">Bayar
                                        Sekarang
                                    </button>
                                    <div class="flex justify-center items-end mr-5">
                                        <span class="text-lg font-medium text-gray-800 mr-3">Total : </span>
                                        <span class="text-lg font-bold text-gray-800 " id="total"> 
                                        </span>
                                        <input type="hidden" name="total" value="333">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var carts;
        var total;

        var status = checkAuth();

        if(status) {   
            console.log('login');
            var temp = [];         
            carts = fetch();
            // console.log(temp);
            // carts = temp;
            console.log(carts);
        } else {
            console.log('meh');
            carts = localStorage.getItem("cart");

            carts = JSON.parse(carts);
        }
        
        showItems(carts);

        function fetch() {
            var newCart;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/fetch",
                data: {user_id: $('#user_id').val()},
                async: false,
                success: function(response) {
                   newCart = response.carts;
                }
            });
            return newCart;            
        }

        function checkAuth() {
            var status;
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route("auth.check") }}',
                async: false,
                success: function(response) {
                    status = response.status;
                }
            });

            return status;
        }

        function showItems(carts) {
            $('#items').html('');
            $('#total').text('');

            total = 0;

            for (const key in carts) {
                if (Object.hasOwnProperty.call(carts, key)) {
                    const element = carts[key];

                    var id;

                    if(status) {
                        id = element.id;
                    } else {
                        id = element.menu.id;
                    }
                    
                    total += (element.menu.price * element.qty);
                    $('#items').append(
                        '<div class="flex justify-between items-center mb-3 pt-3 pb-3 border-b">\
                            <div class="flex ml-5 items-center">\
                                <img src="/storage/' + element.menu.menu_photo_path + '" width="100" class="rounded-full mr-5">\
                                <div class="flex flex-col ml-3">\
                                    <span class="md:text-lg font-medium">' + element.menu.name + '</span>\
                                    <span class="text-s text-gray-400">' + convertIDR(element.menu.price) + '</span>\
                                    <span class="text-s text-gray-400">Jumlah : ' + element.qty + '</span>\
                                </div>\
                            </div>\
                            <div class="flex justify-center items-center mr-5">\
                                <div class="pr-8 ">\
                                    <span class="text-lg font-medium">' + convertIDR(element.menu.price * element.qty) + '</span>\
                                </div>\
                                <div>\
                                    <button id="remove-item" data-menuid="' + id + '"><i class="fa fa-close text-xs font-medium"></i></button>\
                                </div>\
                            </div>\
                        </div>'
                    );
                    // if(status) {
                    //     $('#cart_id').val(element.id);
                    // }
                    console.log(id);
                }
            }

            $('#total').text(convertIDR(total));
        }        

        function convertIDR(number) {
            return number.toLocaleString('id-ID', { 
                style: 'currency', 
                currency: 'IDR' 
            });
        }

        function orders(userId) {
            // store to orders and order details table
            // orders need {id_user, total, order_date}
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/order/add/" + userId,
                data: {
                    user_id: userId,
                    total: total,
                },
                success: function(response) {
                    console.log(response);
                    if(response.odCode == 200) {
                        removeAllItems(userId);

                        window.location.href = "/order/show/" + response.order_id;
                    }
                }
            });
        }

        function removeAllItems(userId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/cart/deletes/" + userId,
                data: {
                    user_id: userId,
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }

        function removeItem(menuId) {
            if(status) {
                console.log('remove item from db');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/cart/delete/" + menuId,
                    data: {
                        cart_id: menuId
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });

                var carts = fetch();

                showItems(carts);
            } else {
                var carts = localStorage.getItem("cart");
                carts = JSON.parse(carts);

                let tempCart = [];
                
                tempCart = carts.filter(function(value, index, arr) {
                    return value.menu.id != menuId;
                });
                
                localStorage.setItem("cart", "[]");
                localStorage.setItem("cart", JSON.stringify(tempCart));

                showItems(tempCart);
            }
            
        }

        $(document).on('click', '#remove-item', function() {
            let menu_id = $(this).data('menuid');
            // console.log( $('#cart_id'));
            // let cart_id = $('#cart_id').val();
            // console.log(cart_id);
            // let id = (status == true) ? cart_id : menu_id ;
            // console.log(id);
            removeItem(menu_id);            
        });

        $(document).on('click', '#order', function(event) {
            event.preventDefault();
            var carts = fetch();

            let id = $('#user_id').val();
            if(carts.length < 1) {
                alert('cannot checkout, please add item(s) to yor cart!');
            } else {
                orders(id);
            }

        });

    });
    
</script>
</html>