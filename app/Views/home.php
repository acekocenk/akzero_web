<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Hello, world!</h1>
            <?php
            // if (!password_verify(base64_encode(hash('SHA256', '@honda800', true)), user()->passord_hash)) {
            //     echo 'password not match';
            // } else {
            //     echo 'password matched';
            // }
            // echo (base64_encode(hash('SHA256', '@honda800', true)));
            ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>