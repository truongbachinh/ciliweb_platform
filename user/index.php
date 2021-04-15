<?php
include "../config_user.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../partials/html_header.php"; ?>
</head>

<body class="sidebar-pinned " style="overflow-x: hidden;">

    <main class="user-main">
        <?php include "../partials/header_user.php"; ?>

        <!-- PLACE CODE INSIDE THIS AREA -->

        <div class="container-fluid">
            <?php
            include('content.php');
            ?>
        </div>



        <!--/ PLACE CODE INSIDE THIS AREA -->
    </main>
    <?php include "../partials/js_libs.php"; ?>
    <?php include "../partials/footer_user.php"; ?>

    <script>
        $(document).ready(function() {
            var options = {
                max_value: 5,
                step_size: 0.5,
                selected_symbol_type: 'utf8_star',
                initial_value: 5,
                update_input_field_name: $("#reviewRank"),
            }
            $(".rate2").rate(options);

            $(".rate2").on("change", function(ev, data) {
                console.log(data.from, data.to);
            });

            $(".rate2").on("updateError", function(ev, jxhr, msg, err) {
                console.log("This is a custom error event");
            });

            $(".rate2").rate("setAdditionalData", {
                id: 42
            });
            $(".rate2").on("updateSuccess", function(ev, data) {
                console.log(data);
            });


        })
        document.addEventListener("DomContentLoaded", function(e) {
            let activeId = null;
            $(document).on('click', 'btn-edit-order', function(e) {
                e.preventDefault();
                const orderUserId = parseInt($(this).data("id"));
                activeId = orderUserId;
                console.log(orderUserId);
                // Utils.api("get_order_user_shipping_info", {
                //     id: orderUserId
                // }).then(response => {
                //     // $("#updateOrderId").html(response.data.id)
                //     // $("#updateOrderAccount").html(response.data.username)
                //     // $("#updateShippingStatus").val(response.data.shipping_order_status)
                //     $('#editOrderUser').modal();
                // }).catch(err => {

                // });
            })




            // $(document).on('click', '.btn-update-order', function(e) {
            //     Utils.api("update_order_shipping_infor", {
            //         id: activeId,
            //         updateOrderShipping: $("#updateShippingStatus").val(),
            //     }).then(response => {
            //         $("#editOrder").modal("hide"),
            //             swal("Notice", response.msg, "success").then(function(e) {
            //                 location.replace("./manage_order.php");
            //             });
            //     }).catch(err => {

            //     })
            // });


        })
    </script>
</body>

</html>

<?php
if (isset($queryInsertReivew)) {
?>
    <script>
        swal("Notice", "Feedback successfully!", "success");
    </script>
<?php
}
?>