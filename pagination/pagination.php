<div style="float: right;">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            if ($currentPage > 2) {
                $firstPage = 1;
            ?>
                <li class="page-item"><a class="page-link" href="?per_page=<?= $pPerPage ?>&page=<?= $firstPage ?>">First</a></li>
            <?php
            }
            ?>

            <?php
            if ($currentPage > 1) {
                $prevPage = $currentPage - 1;
            ?>
                <li class="page-item"><a class="page-link" href="?per_page=<?= $pPerPage ?>&page=<?= $prevPage ?>">Previous</a></li>
            <?php
            }
            ?>

            <?php
            for ($num = 1; $num <= $totalPage; $num++) {
            ?>
                <?php if ($num != $currentPage) { ?>
                    <li class="page-item"><a class="page-link" href="?per_page=<?= $pPerPage ?>&page=<?= $num ?>"><?= $num ?></a></li>

                <?php
                } else {
                ?>
                    <li class="page-item"> <strong class="current-page page-link"><?= $num ?></strong></li>
                <?php
                }
                ?>

            <?php
            }
            ?>

            <?php
            if ($currentPage < $totalPage - 1) {
                $nextPage = $currentPage + 1;

            ?>
                <li class="page-item"><a class="page-link" href="?per_page=<?= $pPerPage ?>&page=<?= $nextPage ?>">Next</a></li>

            <?php
            }
            ?>

            <?php
            if ($currentPage < $totalPage - 3) {
                $endPage = $totalPage;
            ?>

                <li class="page-item"><a class="page-link" href="?per_page=<?= $pPerPage ?>&page=<?= $endPage ?>">Last</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>


</div>