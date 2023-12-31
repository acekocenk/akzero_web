<?php

use CodeIgniter\Filters\CSRF;
?>
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Product</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 mt-4">
                        <img src="/img/product/<?= $product['product_img']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['product_id']; ?></h5>
                            <p class="card-text">Product ID : <?= $product['product_id']; ?></p>
                            <p class="card-text">Product Name : <?= $product['product_name']; ?></p>
                            <a href="/product/edit/<?= $product['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/product/<?= $product['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ?')" ;>delete</button>
                            </form>
                            <br><br>
                            <a href="/product">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>