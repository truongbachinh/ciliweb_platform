<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <?php
        if ($resultShopInfor->num_rows > 0) {
            $shopURL = $rowShop["shop_name"];
        ?>
            <h4 class="admin-brand-logo "><?php echo $shopURL; ?></h4>
        <?php
        } else { ?>

            <p src="" class="admin-brand-logo">Logo Shop </p>
        <?php } ?>

        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
            <?php if (!$isLoggedInShop) : ?>
                <li class="menu-item active ">
                    <a href="../account/login.php" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">
                                Login
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-activity "></i>
                        </span>
                    </a>
                </li>
            <?php else : ?>
                <?php if ($currentUser['user_role_id'] == "1" && $currentUser['user_status'] == "1") : ?>
                    <li class="menu-item ">
                        <a href="../shop/index.php" class=" menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Dashboard</span>
                            </span>
                            <span class="menu-icon"><i class="icon-placeholder fe fe-edit "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item active opened">
                        <a href="#" class="open-dropdown menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Manage Shop
                                    <span class="menu-arrow"></span> </span>
                            </span>
                            <span class="menu-icon">
                                <i class="mdi mdi-buffer mdi-24px "></i>
                            </span>
                        </a>
                        <!--submenu-->
                        <ul class="sub-menu" style="display: block;">
                            <li class="menu-item ">
                                <a href="../shop/manage_product.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Product</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-folder-star mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../shop/manage_staff.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Staff</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-account-multiple   mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../shop/manage_order.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Order</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-basket mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../shop/manage_revenue.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Revenue</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-currency-usd mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../shop/chart.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Chart Analysis</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-chart-bar mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../shop/chat.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Chat </span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-chat-processing mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
            <?php endif; ?>
        </ul>
    </div>
</aside>