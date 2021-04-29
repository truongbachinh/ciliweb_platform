<br><br>
<div class="footer">
    <div class="row">
        <div class="col-md-12" style="text-align: center;">Design by Chính</div>
    </div>
</div>

<script>
    // Show loading overlay when ajax request starts
    $(document).ajaxStart(function() {
        $('.loading-overlay').show();
    });

    // Hide loading overlay when ajax request completes
    $(document).ajaxStop(function() {
        $('.loading-overlay').hide();
    });
    var checkSearch
    var ctg_id = '';
    var shop_id = '';
    // 

    function searchFilterDelay() {
        if (checkSearch) {
            clearTimeout(checkSearch);
        }
        checkSearch = setTimeout(() => {
            searchFilter();
        }, 400);
    }
    $(".btn-get-ctg-id").click(function(event) {
        event.preventDefault();
        ctg_id = parseInt($(this).data("id"));
        console.log("ctg_id", ctg_id)
        searchFilter();
    })

    $(".btn-get-shop-id").click(function(event) {
        event.preventDefault();
        shop_id = parseInt($(this).data("id"));
        console.log("shop_id", shop_id)
        searchFilter();
    })

    function resetSearch() {
        console.log("hello");
        $('#keywords').html('');

    }


    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        $.ajax({
            type: 'POST',
            url: 'getData.php',
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&category=' + ctg_id + '&shop=' + shop_id,
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(html) {
                $('#postContent').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }


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
                    window.location.replace("../cart/cart.php");
                    $.get('../partials/cart_count.php', function(
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
                    swal("Notice", response.message, "warning");
                } else {
                    swal("Notice", response.message, "success");
                    $.get('../partials/cart_count.php', function(
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
                            window.location.replace("../account/login.php");

                        } else {
                            $.get('../cart/ajax_cart_content.php', function(cartContentHTML) {
                                console.log("cart-count", cartContentHTML);
                                $('#cart-form').html(cartContentHTML);
                            })
                            $.get('../partials/cart_count.php', function(
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

    function deleteAllItem() {

        $.ajax({
            type: "POST",
            url: '../cart/process_cart.php?view=delete_all_item',
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {
                    console.log("error")
                } else {
                    swal("Notice", "Delete product successfully!", "success");
                    $.get('../cart/ajax_cart_content.php', function(cartContentHTML) {
                        console.log("cart-count", cartContentHTML);
                        $('#cart-form').html(cartContentHTML);
                    })
                    $.get('../partials/cart_count.php', function(
                        cartCountHTML) {
                        console.log("cart-count", cartCountHTML);
                        $('#cartCountHeader').html(cartCountHTML);
                    })


                }
            }

        })
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
                    window.location.replace("../account/login.php");
                } else {
                    swal("Notice", "Delete product successfully!", "success");
                    $.get('../cart/ajax_cart_content.php', function(cartContentHTML) {
                        console.log("cart-count", cartContentHTML);
                        $('#cart-form').html(cartContentHTML);
                    })
                    $.get('../partials/cart_count.php', function(
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
            $("#updateOrderTime").html(response.data.order_create_time)
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
        }).catch(err => {});
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



    function chatToShop(shopId) {

        var pathFile = "../shop/image_shop/";
        Utils.api("talk_to_shop", {
            id: shopId
        }).then(response => {

            $('#chatToShopAvatar').attr('src', pathFile.concat(response.data.shop_avatar));
            $("#chatToShopName").text(response.data.shop_name);
            $("#chatToShopStatus").text(response.data.session_status);
            $('#chatToShop').modal();

        }).catch(err => {

        })
    }

    function listChatToShop(shopId) {
        var pathFile = "../shop/image_shop/";
        Utils.api("talk_to_shop", {
            id: shopId
        }).then(response => {

            $('#chatToShopAvatar').attr('src', pathFile.concat(response.data.shop_avatar));
            $("#chatToShopName").text(response.data.shop_name);
            $("#chatToShopStatus").text(response.data.session_status);
            $('input[id=incoming_id]').attr('value', response.data.user_id);
            $('#chatToShop').modal();

        }).catch(err => {

        })
        setTimeout(() => {
            MyFunction();
        }, 500);

    }

    function turnOfInterval() {
        console.log("Setinter oke");
        window.location.replace = "./talk_to_user.php";
    }
</script>

<script src="../user/javascript/conversation.js"></script>