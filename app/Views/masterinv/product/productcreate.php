<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h3 class="my-3"><?= $title; ?></h3>
            <form action="/product/save" method="post" enctype="multipart/form-data">
                <!-- <//?= validation_list_errors(); ?> -->
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="productid" class="col-sm-3 col-form-label">Product Id</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= validation_show_error('productid') ? 'is-invalid' : '' ?>" id="productid" name="productid" autofocus value="<?= old('productid'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('productid') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="productname" class="col-sm-3 col-form-label">Product Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control <?= validation_show_error('productname') ? 'is-invalid' : '' ?>" id="productname" name="productname" value="<?= old('productname'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('productname') ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="productimg" class="col-sm-3 col-form-label">Product Image</label>
                    <div class="col-sm-2">
                        <img src="/img/product/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-6">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= validation_show_error('productimg') ? 'is-invalid' : '' ?>" id="productimg" name="productimg" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= validation_show_error('productimg') ?>
                            </div>
                            <label class="custom-file-label" for="productimg">Choose Img...</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function previewImg() {
        const productPic = document.querySelector('#productimg')
        const productPicLabel = document.querySelector('.custom-file-label');
        const productPicPreview = document.querySelector('.img-preview');

        productPicLabel.textContent = productPic.files[0].name;

        const filePicture = new FileReader();
        filePicture.readAsDataURL(productPic.files[0]);

        filePicture.onload = function(e) {
            productPicPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>