<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <img class="admin-brand-logo">Cili Web </img>
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
            <?php if (!$isLoggedIn) : ?>
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
                <?php if ($currentUser['username'] == "admin") : ?>
                    <li class="menu-item ">
                        <a href="../admin/index.php" class=" menu-link">
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
                                <span class="menu-name">Manage System
                                    <span class="menu-arrow"></span> </span>
                            </span>
                            <span class="menu-icon">
                                <i class="mdi mdi-buffer mdi-24px "></i>
                            </span>
                        </a>
                        <!--submenu-->
                        <ul class="sub-menu" style="display: block;">
                            <li class="menu-item ">
                                <a href="../admin/manage_user.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage User</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-account-details mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../admin/manage_role.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Role</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-account-key mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../admin/manage_categories.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Categories</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-book-open-variant mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../admin/manage_shop.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Shop</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-briefcase-plus mdi-24px "></i>
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