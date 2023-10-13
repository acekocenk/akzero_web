<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center"><?= $acction == 'Add' ? 'Form Add Item' : 'Form Edit Item'; ?></h3>
    </div>

    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAdditem">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <!-- <hr> -->
                    <div class="row mb-3">
                        <label for="category" class="control-label col-sm-4" align="right">Category</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="category" name="category" onchange="createitems()">
                                <option selected>XXX</option>
                                <?php foreach ($category as $t) : ?>
                                    <option value="<?= $t['categorycode']; ?>"><?= $t['categoryname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="material" class="control-label col-sm-4" align="right">Material</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="material" name="material" onchange="createitems()">
                                <option selected>XXX</option>
                                <?php foreach ($material as $t) : ?>
                                    <option value="<?= $t['materialcode']; ?>"><?= $t['materialname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="materialtype" class="control-label col-sm-4" align="right">Material Type</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="materialtype" name="materialtype" onchange="createitems()">
                                <option selected>X0X0</option>
                                <?php foreach ($materialtype as $t) : ?>
                                    <option value="<?= $t['materialtypecode']; ?>"><?= $t['materialtypename']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colour" class="control-label col-sm-4" align="right">Colour</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="colour" name="colour" onchange="createitems()">
                                <option selected>XXX</option>
                                <?php foreach ($colour as $t) : ?>
                                    <option value="<?= $t['colourcode']; ?>"><?= $t['colourname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemsize" class="control-label col-sm-4" align="right">item Size</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemsize" name="itemsize" value="0000000" maxlength="7" onchange="createitems()">
                            <div class="invalid-feedback" id="errorSize"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unitsize" class="control-label col-sm-4" align="right">Size Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unitsize" name="unitsize" onchange="createitems()">
                                <option selected>XX</option>
                                <option value="MM">MM</option>
                                <option value="CM">CM</option>
                                <option value="MX">M</option>
                                <option value="FT">FEET</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemcode" class="control-label col-sm-4" align="right">item Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemcode" name="itemcode" value="" readonly autofocus>
                            <div class="invalid-feedback" id="errorCode"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemname" class="control-label col-sm-4" align="right">item Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemname" name="itemname" value="" readonly>
                            <div class="invalid-feedback" id="errorName"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unit" class="control-label col-sm-4" align="right">Item Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unit" name="unit">
                                <option selected>XX</option>
                                <option value="PCS">PCS</option>
                                <option value="SET">SET</option>
                                <option value="BOX">BOX</option>
                                <option value="LTR">LTR</option>
                                <option value="ROL">ROLL</option>
                                <option value="RIM">RIM</option>
                                <option value="MT">M</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="itemimg" class="control-label col-sm-4" align="right">item Image</label>
                        <div class="col-sm-4">
                            <img src="/img/items/default.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="itemimg" name="itemimg" onchange="previewImg()">
                                <div class="invalid-feedback" id="errorImg"></div>
                                <label class="custom-file-label  col-form-label-sm" for="itemimg">Img...</label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" align="right">
                        <button type="submit" class="btn btn-primary" id="btnSave"><i class="fa-solid fa-check"></i>&nbsp;Save</button>
                        <button class="btn btn-danger" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
                        <!-- <input type="submit" name="submit" class="btn btn-primary" value="Register Data">
                            <a href="../mhs/mhs_home.php" class="btn btn-danger">Batal</a> -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->include('masterinv/items/js_item'); ?>