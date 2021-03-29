<?php
include "../connect_db.php";
$idCtg = $_GET["idl"];

// $idl = $_GET["idl"];
$categories = "";
$res = mysqli_query($link, "select * from categories where ctg_id = $idCtg");
$line_Categories = mysqli_fetch_array($res, MYSQLI_ASSOC);
while ($row = mysqli_fetch_array($res)) {
    $categories = $row["ctg_name"];
}
?>

<?php
if ($line_Categories) { ?>
    <p style="background: #e6e6e6; padding: 10px; border-left: 5px solid blue; font-weight: bold; font-size: 18px;"><?php echo $line_Categories['ctg_name'] ?>
    </p>
<?php
}
?>
<div class="row">
    <?php
    if ($count = mysqli_num_rows($res) == 0) {
    ?>
        <h4>No Product Found</h4>
    <?php
    } else {
    ?>
        <?php

        $res = mysqli_query($link, "select * from products where p_category_id = '$idCtg'");
        while ($row = mysqli_fetch_array($res)) {
        ?>
            <div style="padding: 10px">
                <div class="card align-items-center" style="width: 300px; text-align: center;">
                    <a href="index.php?view=foodInfo&idl=<?php echo $line_all['p_category_id'] ?>&id=<?php echo $line_all['p_id'] ?>">
                        <div class="card-header">
                            <img src="../admin<?php echo $row['p_image'] ?>" width="150" height="150">
                        </div>
                        <div class="card-body">
                            <p><?php echo $row['p_name'] ?></p>
                        </div>
                        <div class="card-footer">
                            <span style="color: red; font-size: 14px;">
                                <?php echo $row['p_price'] . 'VND' ?>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>