        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-code"></i>
                </div>
                <div class="sidebar-brand-text mx-3">AK-Zero <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                user Profile
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-user"></i>
                    <span>My Profile</span></a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-user-pen"></i>
                    <span>Edit Profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Inventory
            </div>

            <!-- Nav Item - Purchase -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/po'); ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Purchase Order</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-solid fa-tag"></i>
                    <span>Pricing</span></a>
            </li>

            <!-- Nav Item - Pages Warehouse -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#warehouse" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-warehouse"></i>
                    <span>Warehouse</span>
                </a>
                <div id="warehouse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaction</h6>
                        <a class="collapse-item" href="<?= base_url('/whin'); ?>">Incoming</a>
                        <a class="collapse-item" href="#">Outgoing</a>
                        <a class="collapse-item" href="#">Adjusment</a>
                        <a class="collapse-item" href="#">Return</a>
                        <a class="collapse-item" href="#">Reject</a>
                        <a class="collapse-item" href="#">Opname</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Preparetion -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#preparation" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-industry"></i>
                    <span>Preparetion</span>
                </a>
                <div id="preparation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaction</h6>
                        <a class="collapse-item" href="#">Incoming</a>
                        <a class="collapse-item" href="#">Outgoing</a>
                        <a class="collapse-item" href="#">Adjusment</a>
                        <a class="collapse-item" href="#">Return</a>
                        <a class="collapse-item" href="#">Reject</a>
                        <a class="collapse-item" href="#">Opname</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages FG -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#finishgood" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Finish Good</span>
                </a>
                <div id="finishgood" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaction</h6>
                        <a class="collapse-item" href="#">Incoming</a>
                        <a class="collapse-item" href="#">Outgoing</a>
                        <a class="collapse-item" href="#">Adjusment</a>
                        <a class="collapse-item" href="#">Return</a>
                        <a class="collapse-item" href="#">Reject</a>
                        <a class="collapse-item" href="#">Opname</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Scrap -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#scrap" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-recycle"></i>
                    <span>Scrap</span>
                </a>
                <div id="scrap" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaction</h6>
                        <a class="collapse-item" href="#">Incoming</a>
                        <a class="collapse-item" href="#">Outgoing</a>
                        <a class="collapse-item" href="#">Adjusment</a>
                        <a class="collapse-item" href="#">Return</a>
                        <a class="collapse-item" href="#">Reject</a>
                        <a class="collapse-item" href="#">Opname</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Setup
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterinv" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-recycle"></i>
                    <span>Master Inventory</span>
                </a>
                <div id="masterinv" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Setup Master Inv</h6>
                        <!-- <a class="collapse-item" href="<?= base_url('/bom'); ?>">Bill Of Material</a> -->
                        <a class="collapse-item" href="<?= base_url('/items'); ?>">Items</a>
                        <a class="collapse-item" href="<?= base_url('/category'); ?>">Category</a>
                        <a class="collapse-item" href="<?= base_url('/colour'); ?>">Colour</a>
                        <a class="collapse-item" href="<?= base_url('/material'); ?>">Material</a>
                        <a class="collapse-item" href="<?= base_url('/materialtype'); ?>">Material Type</a>
                        <a class="collapse-item" href="<?= base_url('#'); ?>">Customer</a>
                        <a class="collapse-item" href="<?= base_url('/supplier'); ?>">Supplier</a>
                    </div>
                </div>
            </li>
            <?php if (in_groups('admin')) : ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Admin</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Setup Users</h6>
                            <a class="collapse-item" href="<?= base_url('/group'); ?>">Group</a>
                            <a class="collapse-item" href="<?= base_url('/users'); ?>">User</a>
                            <a class="collapse-item" href="<?= base_url('/permision'); ?>">Permision</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->