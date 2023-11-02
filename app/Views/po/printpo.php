<?= $this->extend('layout/templateprint'); ?>

<?= $this->section('content'); ?>
<div class="row mb-5">
</div>
<center>
    <div class="card border-secondary mb-3" style="max-width: 70rem;">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-2" align="Left">
                    <img src="/img/items/default.png" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-8" align="Left">
                    <!-- <div class="row mb-5"></div> -->
                    <div class="row">
                        <h1><b>PT. BUMI INDAH GLOBAL</b></h1>
                    </div>
                    <div class="row mb-3"></div>
                    <div class="row">
                        <h4>PURCHASE ORDER</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class=" card-body text-secondary">
            <h5 class="card-title">Secondary card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
    </div>
</center>
<?= $this->endSection(); ?>