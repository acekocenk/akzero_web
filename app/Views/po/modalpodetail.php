<!-- MODAL ADD -->
<!-- The Modal -->
<div class="modal fade" id="modaladd">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Item Purchase Order</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAddPoDetail">
                <?= csrf_field(); ?>
                <input type="hidden" id="addpoid" name="addpoid">
                <input type="hidden" id="addpono" name="addpono">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <hr> -->
                            <div class="row mb-2">
                                <label for="additemcode" class="control-label col-sm-4" align="right">Item Name</label>
                                <div class="col-sm-8">
                                    <select class="custom-select custom-select-sm" aria-label="Default select example" id="additemcode" name="additemcode" onchange="getItemName()">
                                        <option selected>XXXXXXXXXXXXXXXXXXXXXX</option>
                                        <?php foreach ($item as $t) : ?>
                                            <option value="<?= $t['itemcode']; ?>"><?= $t['itemname']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="additemname" class="control-label col-sm-4" align="right">Item Name PO</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="additemname" name="additemname" value="XXXXXXXXXXXXXXXXXXXXXX">
                                    <div class="invalid-feedback" id="erroradditemname"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addqty1" class="control-label col-sm-4" align="right">Frist Qty</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="addqty1" name="addqty1">
                                    <div class="invalid-feedback" id="erroraddqty1"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addunit1" class="control-label col-sm-4" align="right">Frist Qty Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="addunit1" name="addunit1">
                                    <div class="invalid-feedback" id="erroraddunit1"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addqty2" class="control-label col-sm-4" align="right">Second Qty</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="addqty2" name="addqty2">
                                    <div class="invalid-feedback" id="erroraddqty2"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addunit2" class="control-label col-sm-4" align="right">Second Qty Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="addunit2" name="addunit2">
                                    <div class="invalid-feedback" id="erroraddunit2"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addqtyprice" class="control-label col-sm-4" align="right">Qty Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="addqtyprice" name="addqtyprice" onkeyup="calculate()">
                                    <div class="invalid-feedback" id="erroraddqtyprice"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addpriceunit" class="control-label col-sm-4" align="right">Qty Price Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="addpriceunit" name="addpriceunit">
                                    <div class="invalid-feedback" id="erroraddpriceunit"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addprice" class="control-label col-sm-4" align="right">Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" step="0.0001" id="addprice" name="addprice" onkeyup="calculate()">
                                    <div class="invalid-feedback" id="erroraddprice"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addtotal" class="control-label col-sm-4" align="right">Total</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" step="0.0001" readonly="true" id="addtotal" name="addtotal">
                                    <div class="invalid-feedback" id="erroraddtotal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" id="btnCancelPoDetail"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSavePoDetail"><i class="fa-solid fa-check"></i>&nbsp;Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL ADD-->
<!-- MODAL EDIT -->
<!-- The Modal -->
<div class="modal fade" id="modaledit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Item Purchase Order</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmEditPoDetail">
                <?= csrf_field(); ?>
                <input type="hidden" id="editid" name="editid">
                <input type="hidden" id="editpoid" name="editpoid">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <hr> -->
                            <div class="row mb-3">
                                <label for="edititemcode" class="control-label col-sm-4" align="right">Item Name</label>
                                <div class="col-sm-8">
                                    <select class="custom-select custom-select-sm" aria-label="Default select example" id="edititemcode" name="edititemcode" onchange="getItemName()">
                                        <option selected>XXXXXXXXXXXXXXXXXXXXXX</option>
                                        <?php foreach ($item as $t) : ?>
                                            <option value="<?= $t['itemcode']; ?>"><?= $t['itemname']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edititemname" class="control-label col-sm-4" align="right">Item Name PO</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="edititemname" name="edititemname">
                                    <div class="invalid-feedback" id="erroredititemname"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editqty1" class="control-label col-sm-4" align="right">Frist Qty</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="editqty1" name="editqty1">
                                    <div class="invalid-feedback" id="erroreditqty1"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editunit1" class="control-label col-sm-4" align="right">Frist Qty Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="editunit1" name="editunit1">
                                    <div class="invalid-feedback" id="erroreditunit1"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editqty2" class="control-label col-sm-4" align="right">Second Qty</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="editqty2" name="editqty2">
                                    <div class="invalid-feedback" id="erroreditqty2"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editunit2" class="control-label col-sm-4" align="right">Second Qty Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="editunit2" name="editunit2">
                                    <div class="invalid-feedback" id="erroreditunit2"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editqtyprice" class="control-label col-sm-4" align="right">Qty Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" id="editqtyprice" name="editqtyprice" onkeyup="calculateedit()">
                                    <div class="invalid-feedback" id="erroreditqtyprice"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editpriceunit" class="control-label col-sm-4" align="right">Qty Price Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="editpriceunit" name="editpriceunit">
                                    <div class="invalid-feedback" id="erroreditpriceunit"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="editprice" class="control-label col-sm-4" align="right">Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" step="0.00001" id="editprice" name="editprice" onkeyup="calculateedit()">
                                    <div class="invalid-feedback" id="erroreditprice"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edittotal" class="control-label col-sm-4" align="right">Total</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm" step="0.00001" readonly="true" id="edittotal" name="edittotal">
                                    <div class="invalid-feedback" id="erroredittotal"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" id="btnCancelPoDetail"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnUpdatePoDetail"><i class="fa-solid fa-check"></i>&nbsp;Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL EDIT-->