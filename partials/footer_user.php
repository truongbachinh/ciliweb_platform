<br><br>
<div class="footer">
    <div class="row">
        <div class="col-md-12" style="text-align: center;">Design by Chính</div>
    </div>
</div>

<script>
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
    $(".buy-form").submit(function(event) {
        event.preventDefault();
        console.log("data", $(this).serializeArray());

        $.ajax({
            type: "POST",
            url: '../cart/process_cart.php?view=add_to_cart',
            data: $(this).serializeArray(),
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {

                } else {

                    swal("Notice", response.message, "success");


                    setInterval(function() {
                        window.location.replace("../cart/cart.php");
                    }, 1000);


                    // alert(response.message);
                    $.get('https://ciliweb.vn/ciliweb_platform/partials/cart_count.php', function(
                        cartCountHTML) {
                        console.log("cart-count", cartCountHTML);
                        $('#cartCountHeader').html(cartCountHTML);

                    })


                }
            }

        })


    })
    $(".buy-now-form").submit(function(event) {
        event.preventDefault();
        console.log("data", $(this).serializeArray());

        $.ajax({
            type: "POST",
            url: '../cart/process_cart.php?view=add_to_cart',
            data: $(this).serializeArray(),
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {

                } else {

                    swal("Notice", response.message, "success");
                    // alert(response.message);
                    $.get('https://ciliweb.vn/ciliweb_platform/partials/cart_count.php', function(
                        cartCountHTML) {
                        console.log("cart-count", cartCountHTML);
                        $('#cartCountHeader').html(cartCountHTML);
                    })
                }
            }

        })


    })

    function updateQuantity(quantity) {
        if (quantity != "") {
            console.log(quantity);
            $.ajax({
                type: "POST",
                url: '../cart/process_cart.php?view=update_cart',
                data: $('#updateCartProduct').serializeArray(),
                success: function(res) {
                    if (res) {
                        var response = JSON.parse(res);
                        if (response.status == 0) {


                        } else {
                            $.get('../cart/ajax_cart_content.php', function(cartContentHTML) {
                                console.log("cart-count", cartContentHTML);
                                $('#cart-form').html(cartContentHTML);
                            })
                            $.get('https://ciliweb.vn/ciliweb_platform/partials/cart_count.php', function(
                                cartCountHTML) {
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
            url: '../cart/process_cart.php?view=delete_cart_item',
            data: {
                "id": productId
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {

                } else {
                    swal("Notice", "Delete product successfully!", "success");
                    $.get('../cart/ajax_cart_content.php', function(cartContentHTML) {
                        console.log("cart-count", cartContentHTML);
                        $('#cart-form').html(cartContentHTML);
                    })
                    $.get('https://ciliweb.vn/ciliweb_platform/partials/cart_count.php', function(
                        cartCountHTML) {
                        console.log("cart-count", cartCountHTML);
                        $('#cartCountHeader').html(cartCountHTML);
                    })


                }
            }

        })
    }

    function editOrderUser(orderId) {
        console.log('hello', orderId)
        $('#editOrderUser .btn-update-order').unbind('click');
        Utils.api("get_order_user_shipping_info", {
            id: orderId
        }).then(response => {
            $("#idOrderUser").val(response.data.id)
            $("#updateOrderId").html(response.data.id)
            $("#updateOrderAccount").html(response.data.username)
            // $("#updateOrderTime").html(date("Y-d-m, H:i:s", response.data.order_create_time))
            $("#updateShippingStatus").val(response.data.shipping_order_status)
            $('#editOrderUser').modal();
            $('#editOrderUser .btn-update-order').click(() => {
                Utils.api("update_order_user_shipping_infor", {
                    id: orderId,
                    updateShippingStatus: $("#updateShippingStatus").val(),
                }).then((response) => {
                    swal("Notice", response['msg'], "success").then(function(e) {
                        location.reload()
                    });
                    $('#feedbackForm').modal();
                });
            });
        }).catch(err => {

        });
    }

    // $(document).on('click', '.btn-detail-shop', function(e) {
    //     e.preventDefault();
    //     const shopId = parseInt($(this).data("id"));
    //     console.log(shopId)
    //     Utils.api('get_shop_info_detail', {
    //         id: shopId
    //     }).then(response => {
    //         $('#detailShopAccount').text(response.data.username);
    //         $('#detailShopName').text(response.data.shop_name);
    //         $('#detailShopMail').text(response.data.email);
    //         $('#detailShopAddress').text(response.data.shop_address);
    //         $('#detailShopDescription').text(response.data.shop_description);
    //         // var createDate = date("Y-m-d H:i:s", response.data.shop_create_time);
    //         // $('#detailShopCreateTime').text(createDate);
    //         // $('#detailShopUpdateTime').text(date("Y-m-d H:i:s", response.data.shop_update_time));
    //         $('#detailShop').modal();
    //     }).catch(err => {

    //     })
    // });

    // function feedbackProduct(productId) {
    //     $("#fbProduct").val(productId);
    //     $('#feedbackProductFrom').modal();
    // }

    function feedbackProduct(productId) {
        var pathFile = "../shop/image_products/";
        Utils.api("feedback_product", {
            id: productId
        }).then(response => {

            $("#fbProductId").val(productId);
            $("#fbShopId").val(response.data.shop_id);
            $("#fbProductShop").text(response.data.shop_name);
            $("#fbProductName").text(response.data.p_name);
            $('#detailProduct').attr('src', pathFile.concat(response.data.p_image));
            $('#feedbackProductFrom').modal();
        }).catch(err => {

        })
    }
</script>