<link rel="stylesheet" href="../user/css/categories.css">
<div class="container-fluid " style="overflow: hidden; ">
    <div class="ctg">
        <span id="ctg-list"> <i class="fa fa-list-alt" aria-hidden="true"> Categories</span></i>
    </div>
    <form id="form1" runat="server">
        <div class="categories ">
            <div id="arrowL">
                <i class="mdi mdi-chevron-left mdi:24px" aria-hidden="true" id="arrow-button"></i>
            </div>
            <div id="arrowR">
                <i class="mdi mdi-chevron-right mdi:24px" aria-hidden="true" id="arrow-button"></i>
            </div>
            <div class="list">
                <div class="list-group list-group-horizontal col-lg-9 d-md-flex" id="view-list-categories">
                    <?php
                    $resultCategories =  $link->query("SELECT categories.* from categories");
                    while ($row = mysqli_fetch_array($resultCategories)) {
                    ?>
                        <div class="item-categories " style="width: 120px; "><a href="index.php?view=categories&idl=<?php echo $row["ctg_id"]; ?>" style="text-decoration: none;">
                                <div class="card card-block card-4" style="margin-top: 6px;">
                                    <div class="card-body">

                                        <?php
                                        if ($resultCategories->num_rows > 0) {
                                            $imageURL = '../admin/image_categories/' . $row["ctg_image"];
                                        ?>
                                            <img src="<?php echo $imageURL; ?>" alt="" height="50" width="50" style="border-radius:10px" />
                                        <?php
                                        } else { ?>
                                            <p>No image(s) found...</p>

                                        <?php }
                                        ?>

                                        <p class="card-text" style="margin-top: 20px;color:#fff "><?php echo $row["ctg_name"]; ?></p>

                                    </div>

                                </div>

                            </a>
                        </div>
                    <?php
                    }
                    ?>



                </div>
            </div>



        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var $item = $('div.item-categories'), //Cache your DOM selector
                    visible = 4, //Set the number of items that will be visible
                    index = 0, //Starting index
                    endIndex = ($item.length / visible) - 1; //End index

                $('div#arrowR').click(function() {
                    debugger;

                    if (index < endIndex) {
                        index++;
                        $item.animate({
                            'left': '-=600px'
                        });
                    }
                });

                $('div#arrowL').click(function() {
                    if (index > 0) {
                        index--;
                        $item.animate({
                            'left': '+=600px'
                        });
                    }
                });

            });
        </script>
    </form>
</div>
<br>