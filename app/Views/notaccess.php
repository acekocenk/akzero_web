<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h1>Not Access</h1> -->
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

<script type="text/javascript">
    $(document).ready(function() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "You Can't Accesss This Pages",
            showConfirmButton: false,
            timer: 1500
            // footer: '<a href="">Why do I have this issue?</a>'
        })
        window.location.replace('/');
    });
</script>

<?= $this->endSection(); ?>