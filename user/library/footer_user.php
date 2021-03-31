<br><br>
<div class="footer">
    <div class="row">
        <div class="col-md-12" style="text-align: center;">Design by Chính</div>
    </div>
</div>

<script>
    $(".buy-now-form").submit(function(event) {
        event.preventDefault();
        console.log("data", $(this).serializeArray());

        $.ajax({
            type: "POST",
            url: '../user/cart/process_cart.php?view=add_to_cart',
            data: $(this).serializeArray(),
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {

                } else {
                    alert(response.message);
                    $.get('cartCount.php', function(cartCountHTML) {
                        console.log("cart-count", cartCountHTML);
                        $('#cartCountHeader').html(cartCountHTML);
                    })
                }
            }

        })


    })
    // $.fn.serializeObject = function() {
    //     var o = {};
    //     var a = this.serializeArray();
    //     $.each(a, function() {
    //         if (o[this.name] !== undefined) {
    //             if (!o[this.name].push) {
    //                 o[this.name] = [o[this.name]];
    //             }
    //             o[this.name].push(this.value || '');
    //         } else {
    //             o[this.name] = this.value || '';
    //         }
    //     });
    //     return o;
    // };

    // function updateQuantity(quantity) {
    //     if (quantity != "") {
    //         var dataCart = $('#updateCartProduct').serializeObject();
    //         dataCart = JSON.stringify(dataCart);
    //         $.ajax({
    //             type: "POST",
    //             contentType: "application/json; charset=utf-8",
    //             dataType: 'JSON',
    //             url: 'process_cart.php?view=update_cart',
    //             data: dataCart,
    //             success: function(res) {
    //                 if (res) {
    //                     var response = parseJSON(res);
    //                     if (responses.status == 0) {


    //                     } else {
    //                         $.get('ajax_cart_content.php', function(cartContentHTML) {
    //                             console.log("cart-count", cartContentHTML);
    //                             $('#cart-form').html(cartContentHTML);
    //                         })

    //                     }
    //                 }
    //             }
    //         })
    //     }
    // }
    function updateQuantity(quantity) {
        if (quantity != "") {
            console.log(quantity);
            $.ajax({
                type: "POST",
                url: 'process_cart.php?view=update_cart',
                data: $('#updateCartProduct').serializeArray(),
                success: function(res) {
                    if (res) {
                        var response = JSON.parse(res);
                        if (response.status == 0) {


                        } else {
                            $.get('ajax_cart_content.php', function(cartContentHTML) {
                                console.log("cart-count", cartContentHTML);
                                $('#cart-form').html(cartContentHTML);
                            })
                            $.get('../user/cartCount.php', function(cartCountHTML) {
                                console.log("cart-count", cartCountHTML);
                                $('#cartCountHeader').html(cartCountHTML);
                            })

                        }
                    }
                }
            })
        }
    }



    function deleteCartItem(productId) {
        console.log("product Id: ", productId);
        $.ajax({
            type: "POST",
            url: 'process_cart.php?view=delete_cart_item',
            data: {
                "id": productId
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {

                } else {

                    $.get('../user/cartCount.php', function(cartCountHTML) {
                        console.log("cart-count", cartCountHTML);
                        $('#cartCountHeader').html(cartCountHTML);
                    })
                    $.get('ajax_cart_content.php', function(cartContentHTML) {
                        console.log("cart-count", cartContentHTML);
                        $('#cart-form').html(cartContentHTML);
                    })

                }
            }

        })
    }
</script>