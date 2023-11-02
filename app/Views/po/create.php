<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h3 class="my-3"><//?= $title; ?></h3> -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h3 align="center"><?= $title; ?></h3>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAddPo">
                        <?= csrf_field(); ?>
                        <input type="hidden" id="poformid" name="poformid" value=<?= $poformid; ?>>
                        <input type="hidden" id="poid" name="poid">
                        <input type="hidden" id="ponoold" name="ponoold">
                        <input type="hidden" id="postatus" name="postatus">

                        <div class="row mb-3">
                            <div class="col">
                                <label for="potype" class="control-label">PO Type</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="potype" name="potype" onchange="getPONO()">
                                    <option selected></option>
                                    <option value="Local">Local</option>
                                    <option value="Import">Import</option>
                                </select>
                                <div class="invalid-feedback" id="errorPoType"></div>
                            </div>
                            <div class="col">
                                <label for="pono" class="control-label">PO NO</label>
                                <input class="form-control form-control-sm" id="pono" name="pono" type="input">
                                <div class="invalid-feedback" id="errorPoNo"></div>
                            </div>
                            <div class="col">
                                <label for="supplierid" class="control-label">Supplier</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="supplierid" name="supplierid">
                                    <option selected></option>
                                    <?php foreach ($supplier as $t) : ?>
                                        <option value="<?= $t['id']; ?>"><?= $t['suppliername']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback" id="errorSupplier"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="podate" class="control-label">PO Date</label>
                                <input class="form-control form-control-sm" id="podate" name="podate" type="date">
                            </div>
                            <div class="col">
                                <label for="indate" class="control-label">PO Date In</label>
                                <input class="form-control form-control-sm" id="indate" name="indate" type="date">
                            </div>
                            <div class="col">
                                <label for="currency" class="control-label">Currency</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="currency" name="currency">
                                    <option selected></option>
                                    <option value="IDR">IDR</option>
                                    <option value="AUD">AUD</option>
                                    <option value="RMB">RMB</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="box-footer" align="right">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnSavePo" value="save"><i class="fa-solid fa-check"></i>&nbsp;Create PO</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnProcessPo" value="update" hidden><i class="fa-solid fa-check"></i>&nbsp;Process PO</button>
                                    <!-- <button type="button" class="btn btn-primary btn-sm" id="btnEnable" onclick="enableInput()"><i class="fa-solid fa-check"></i>&nbsp;Enable PO</button> -->
                                    <a class="btn btn-danger btn-sm" href="<?= base_url('po/') ?>" role="button" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</a>
                                </div>
                            </div>
                        </div>
                        <div class="formviewpodetail">
                            <button type="button" id="btnAddDetail" class="btn btn-primary btn-sm mt-3 mb-3" disabled> <i class="fa-solid fa-circle-plus fa-xl"></i>&nbsp;Add</button>
                            <div class="row mb-3">
                                <div class="table-responsive small">
                                    <table id="tbPODetail" name="tbPODetail" class="table table-striped table-sm" width="150%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>First Qty</th>
                                                <th>First Unit</th>
                                                <th>Second Qty</th>
                                                <th>Second Unit</th>
                                                <th>Price Qty</th>
                                                <th>Price Qty Unit</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbPODetailData">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <label for="discount" class="control-label col-sm-8" align="right">Discount</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" style="direction: rtl;" step="0.0001" id="discount" name="discount" value="0" min="0" onkeyup="getPOSUM()">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="ppn" class="control-label col-sm-8" align="right">PPN</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" style="direction: rtl;" id="ppn" name="ppn" value="0" min="0" onkeyup="getPOSUM()">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                                <label for="ppn" class="control-label col-sm-2">%</label>
                            </div>
                            <div class="row">
                                <label for="grandtotal" class="control-label col-sm-8" align="right">Grand Total</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" style="direction: rtl;" step="0.0001" id="grandtotal" name="grandtotal" readonly="true" value="0" min="0">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('po/modalpodetail'); ?>
<?= $this->include('po/jspo'); ?>
<?= $this->endSection(); ?>