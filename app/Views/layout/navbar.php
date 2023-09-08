<div class="container">
    <nav class="navbar navbar-expand-lg bg-light rounded" aria-label="Eleventh navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('/'); ?>">AK-ZERO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('/'); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/home/about'); ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/home/contact'); ?>">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Master Setup</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/bom'); ?>">Bill Of Material</a></li>
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/category'); ?>">Category</a></li>
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/colour'); ?>">Colour</a></li>
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/material'); ?>">Material</a></li>
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/materialtype'); ?>">Material Type</a></li>
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/product'); ?>">Product</a>
                            <li><a class="dropdown-item" type="button" href="<?= base_url('/supplier'); ?>">Supplier</a>
                            <li><a class="dropdown-item" type="button">Customers</a></li>
                            <li><a class="dropdown-item" type="button">Location Items in WH</a></li>
                            <li><a class="dropdown-item" type="button">Location Items in PP</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">User
                            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Dashboard</a>
                            <a class="dropdown-item" href="#">Edit Profile</a>
                            <a class="dropdown-item" href="/logout">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>