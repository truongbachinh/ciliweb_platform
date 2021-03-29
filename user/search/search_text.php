<?php
$and = "";
if (isset($_GET['idl'])) {
    $and = "and ctg_id='$_GET[idl])'";
}

$searchText = "";
if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];
}

$sql_search = "select * from products where p_name LIKE '%$searchText%' " . $and;
$query_search = mysqli_query($conn, $sql_search);

$line_kind = "";
if (isset($_GET['idl'])) {
    $sql_kind = "select * from categories where ctg_id='$_GET[idl]'";
    $query_kind = mysqli_query($conn, $sql_kind);
    $line_kind = mysqli_fetch_array($query_kind, MYSQLI_ASSOC);
}
?>

<hr>

<?php
if ($line_kind) { ?>
    <p style="background: #e6e6e6; padding: 10px; border-left: 5px solid blue; font-weight: bold; font-size: 18px;"><?php echo $line_kind['ctg_name'] ?>
    </p>
<?php
}
?>
<div class="row">
    <?php
    if ($count = mysqli_num_rows($query_search) == 0) {
    ?>
        <h4>No Product Found</h4>
    <?php
    } else {
    ?>
        <?php
        while ($line_search = mysqli_fetch_array($query_search, MYSQLI_ASSOC)) {
        ?>
            <div style="padding: 10px">
                <div class="card align-items-center" style="width: 300px; text-align: center;">
                    <a href="index.php?view=foodInfo&id=<?php echo $line_search['p_id'] ?>">
                        <div class="card-header">
                            <img src="../admin<?php echo $line_search['p_image'] ?>" width="150" height="150">
                        </div>
                        <div class="card-body">
                            <p><?php echo $line_search['p_name'] ?></p>
                        </div>
                        <div class="card-footer">
                            <span style="color: red; font-size: 14px;">
                                <?php echo $line_search['p_price'] . 'VND' ?>
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