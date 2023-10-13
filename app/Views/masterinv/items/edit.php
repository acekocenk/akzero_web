<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center"><?= $acction == 'Edit' ? 'Form Edit Item' : 'Form Add Item'; ?></h3>
    </div>

    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmEditItem">
            <?= csrf_field(); ?>
            <input type="hidden" id="id" name="id" value="<?= $items['id']; ?>">
            <input type="hidden" id="itemcodelama" name="itemcodelama" value="<?= $items['itemcode']; ?>">
            <input type="hidden" name="itemimgLama" value="<?= $items['itemimg']; ?>">
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
                                    <option value="<?= $t['categorycode']; ?>" <?= $t['categorycode'] == $items['categorycode'] ? "selected" : null; ?>><?= $t['categoryname']; ?> </option>
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
                                    <option value="<?= $t['materialcode']; ?>" <?= $t['materialcode'] == $items['materialcode'] ? "selected" : null; ?>><?= $t['materialname']; ?> </option>
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
                                    <option value="<?= $t['materialtypecode']; ?>" <?= $t['materialtypecode'] == $items["materialtypecode"] ? "selected" : null; ?>><?= $t['materialtypename']; ?> </option>
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
                                    <option value="<?= $t['colourcode']; ?>" <?= $t['colourcode'] == $items["colourcode"] ? "selected" : null; ?>><?= $t['colourname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemsize" class="control-label col-sm-4" align="right">item Size</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemsize" name="itemsize" value="<?= $items["size"] ?>" maxlength="7" onchange="createitems()">
                            <div class="invalid-feedback" id="errorSize"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unitsize" class="control-label col-sm-4" align="right">Size Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unitsize" name="unitsize" onchange="createitems()">
                                <option selected>XX</option>
                                <option value="MM" <?= "MM" == $items['sizeunit'] ? "selected" : null ?>>MM</option>
                                <option value="CM" <?= "CM" == $items['sizeunit'] ? "selected" : null ?>>CM</option>
                                <option value="MX" <?= "MX" == $items['sizeunit'] ? "selected" : null ?>>M</option>
                                <option value="FT" <?= "FT" == $items['sizeunit'] ? "selected" : null ?>>FEET</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemcode" class="control-label col-sm-4" align="right">item Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemcode" name="itemcode" value="<?= $items['itemcode']; ?>" readonly autofocus>
                            <div class="invalid-feedback" id="errorCode"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemname" class="control-label col-sm-4" align="right">item Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemname" name="itemname" value="<?= $items['itemname'] ?>" readonly>
                            <div class="invalid-feedback" id="errorName"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unit" class="control-label col-sm-4" align="right">Item Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unit" name="unit">
                                <option selected>XX</option>
                                <option value="PCS" <?= "PCS" == $items['unit'] ? "selected" : null ?>>PCS</option>
                                <option value="SET" <?= "SET" == $items['unit'] ? "selected" : null ?>>SET</option>
                                <option value="BOX" <?= "BOX" == $items['unit'] ? "selected" : null ?>>BOX</option>
                                <option value="LTR" <?= "LTR" == $items['unit'] ? "selected" : null ?>>LTR</option>
                                <option value="ROL" <?= "ROL" == $items['unit'] ? "selected" : null ?>>ROLL</option>
                                <option value="RIM" <?= "RIM" == $items['unit'] ? "selected" : null ?>>RIM</option>
                                <option value="MTR" <?= "MTR" == $items['unit'] ? "selected" : null ?>>M</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemimg" class="control-label col-sm-4" align="right">Item Image</label>
                        <div class="col-sm-4">
                            <img src="/img/items/<?= $items['itemimg']; ?>" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="itemimg" name="itemimg" value="<?= old($items['itemimg']); ?>" onchange="previewImg()">
                                <div class="invalid-feedback" id="errorImg"></div>
                                <label class="custom-file-label  col-form-label-sm" for="itemimg"><?= $items['itemimg']; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" align="right">
                        <button type="submit" class="btn btn-primary" id="btnUpdate"><i class="fa-solid fa-check"></i>&nbsp;Update</button>
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