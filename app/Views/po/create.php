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
                        <input type="hidden" id="poid" name="poid">
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnSavePo" value="update"><i class="fa-solid fa-check"></i>&nbsp;Process PO</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="btnEnable" onclick="enableInput()"><i class="fa-solid fa-check"></i>&nbsp;Enable PO</button>
                                    <a class="btn btn-danger btn-sm" href="#" role="button" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</a>
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
                                    <input type="number" class="form-control form-control-sm" style="direction: rtl;" step="0.0001" id="discount" name="discount" value="0" onchange="getPOSUM()">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="ppn" class="control-label col-sm-8" align="right">PPN</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" style="direction: rtl;" id="ppn" name="ppn" value="0" onchange="getPOSUM()">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                                <label for="ppn" class="control-label col-sm-2">%</label>
                            </div>
                            <div class="row">
                                <label for="grandtotal" class="control-label col-sm-8" align="right">Grand Total</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" style="direction: rtl;" step="0.0001" id="grandtotal" name="grandtotal" value="0">
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
                                    <select class="custom-select custom-select-sm" aria-label="Default select example" id="additemcode" name="additemcode" onchange=" getItemName()">
                                        <option selected></option>
                                        <?php foreach ($item as $t) : ?>
                                            <option value="<?= $t['itemcode']; ?>"><?= $t['itemname']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="additemname" class="control-label col-sm-4" align="right">Item Name PO</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm text-uppercase" id="additemname" name="additemname">
                                    <div class="invalid-feedback" id="erroradditemname"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addqty1" class="control-label col-sm-4" align="right">Frist Qty</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="addqty1" name="addqty1">
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="addqty2" name="addqty2">
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="addqtyprice" name="addqtyprice" onchange="calculate()">
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" step="0.0001" id="addprice" name="addprice" onchange="calculate()">
                                    <div class="invalid-feedback" id="erroraddprice"></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="addtotal" class="control-label col-sm-4" align="right">Total</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm text-uppercase" step="0.0001" id="addtotal" name="addtotal">
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
                <input type="input" id="editid" name="editid">
                <input type="input" id="editpoid" name="editpoid">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- <hr> -->
                            <div class="row mb-3">
                                <label for="edititemcode" class="control-label col-sm-4" align="right">Item Name</label>
                                <div class="col-sm-8">
                                    <select class="custom-select custom-select-sm" aria-label="Default select example" id="edititemcode" name="edititemcode" onchange=" getItemName()">
                                        <option selected></option>
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="editqty1" name="editqty1">
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="editqty2" name="editqty2">
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="editqtyprice" name="editqtyprice" onchange="calculate()">
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
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="editprice" name="editprice" onchange="calculate()">
                                    <div class="invalid-feedback" id="erroreditprice"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edittotal" class="control-label col-sm-4" align="right">Total</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-sm text-uppercase" id="edittotal" name="edittotal">
                                    <div class="invalid-feedback" id="erroredittotal"></div>
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
<!--END MODAL EDIT-->
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        $("#btnAddDetail").click(function() {
            $("#modaladd").modal('show');
            $("#frmAddPoDetail").trigger("reset");
            getPO();
        });
        getDate();
        poSave();
        podetailSave();
        // ViewDataTablePoDetail();
    });

    function ViewDataTablePoDetail() {
        var poid = $("#addpoid").val();
        dataTablePO = $('#tbPODetail').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('po/loadlistpo_detail') ?>",
                type: "POST",
                data: {
                    poid: poid
                },
                dataType: "json",
            },
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            "autoWidth": true,
            "bDestroy": true,
        });

    }

    function getPO() {
        var pono = $("#pono").val();
        $.ajax({
            url: "<?= base_url('po/getpo') ?>",
            type: "GET",
            data: {
                pono: pono
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(id, pono) {
                    $('#poid').val(data.id);
                    $('#addpoid').val(data.id);
                    $('#addpono').val(data.pono);
                    // document.getElementById("poid").value = data.id;
                    // document.getElementById("addpoid").value = data.id;
                    // document.getElementById("addpono").value = data.pono;
                    // alert(data.id);
                });
            }
        });
    }

    function getPONO() {
        var potype = $("#potype").val();
        $.ajax({
            url: "<?= base_url('po/getpono') ?>",
            type: "GET",
            data: {
                potype: potype
            },
            dataType: "json",
            success: function(response) {
                if (response.pono) {
                    document.getElementById("pono").value = response.pono;
                    // alert(response.pono);
                } else {
                    document.getElementById("pono").value = "0";
                }
            }
        });
    }

    function getPOSUM() {
        var id = $("#poid").val();
        var dis;
        var ppn;
        var grandtotal;
        $.ajax({
            url: "<?= base_url('po/getposum') ?>",
            type: "GET",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.gt) {
                    gt = parseFloat(response.gt);
                    dis = parseFloat($('#discount').val());
                    ppn = parseFloat($('#ppn').val());

                    ppn = (ppn * gt) / 100;
                    gt = (gt - dis) + ppn;

                    $('#grandtotal').val(value = gt.toFixed(4));
                } else {
                    gt = 0;
                    $('#grandtotal').val(value = gt.toFixed(4));
                }
            }
        });
    }

    function getDate() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;
        document.getElementById("podate").value = today;
        document.getElementById("indate").value = today;
    }

    function calGt() {
        var dis = parseFloat($('#discount').val());
        var ppn = parseFloat($('#ppn').val());
        var gt = parseFloat($('#grandtotal').val());

        ppn = (ppn * gt) / 100;
        gt = (gt - dis) + ppn;

        alert(gt.toFixed(4));
    }

    // function getItems() {
    //     $('#additemcode').inputpicker({
    //         url: "<//?= base_url('po/getItems') ?>",
    //         fields: ['itemcode', 'itemname', ''],
    //         fieldText: 'itemname',
    //         fieldValue: 'itemcode',
    //         filterOpen: true,
    //         headShow: true,
    //         pageMode: '',
    //         pageField: 'p',
    //         pageLimitField: 'per_page',
    //         limit: 5,
    //         pageCurrent: 1,
    //     });
    // }

    function enableInput() {
        $('#potype').removeAttr('disabled');
        $('#pono').attr('readonly', false);
        $('#supplierid').removeAttr('disabled');
    }

    function poSave() {
        $('#frmAddPo').submit(function(e) {
            e.preventDefault();
            var btnval = $('#btnSavePo').val();

            alert(btnval);

            // $.ajax({
            //     type: "post",
            //     url: "<?= base_url('po/savePo') ?>",
            //     data: new FormData(this), //$(this).serialize(),
            //     dataType: "json",
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     beforeSend: function(xhr) {
            //         $('#btnSavePo').attr('disable', 'disable');
            //         $('#btnSavePo').html('<i class="fa fa-spin fa-spinner"</i>');
            //     },
            //     complete: function() {
            //         $('#btnSavePo').removeAttr('disable');
            //         $('#btnSavePo').html('Create PO');
            //     },
            //     success: function(response) {
            //         if (response.error) {
            //             // alert("Form Submited Successfully");
            //             // Validasi---------------------------------------
            //             if (response.error.potype) {
            //                 $('#potype').addClass('is-invalid');
            //                 $('#errorPoType').html(response.error.potype);
            //             } else {
            //                 $('#potype').removeClass('is-invalid');
            //                 $('#errorPoType').html('');
            //             }

            //             if (response.error.pono) {
            //                 $('#pono').addClass('is-invalid');
            //                 $('#errorPoNo').html(response.error.pono);
            //                 getPONO();
            //                 $('#pono').removeClass('is-invalid');
            //                 $('#errorPoNo').html('');
            //                 $('#btnSavePo').click();
            //             } else {
            //                 $('#pono').removeClass('is-invalid');
            //                 $('#errorPoNo').html('');
            //             }

            //             if (response.error.supplierid) {
            //                 $('#supplierid').addClass('is-invalid');
            //                 $('#errorSupplier').html(response.error.supplierid);
            //             } else {
            //                 $('#supplierid').removeClass('is-invalid');
            //                 $('#errorSupplier').html('');
            //             }
            //             // endValidasi------------------------------------
            //         } else {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Success',
            //                 text: response.sukses,
            //                 showConfirmButton: false,
            //                 timer: 1500
            //             })
            //             getPO();

            //             $('#potype').removeClass('is-invalid');
            //             $('#pono').removeClass('is-invalid');
            //             $('#supplierid').removeClass('is-invalid');

            //             $('#potype').attr('disabled', 'disabled');
            //             $('#pono').attr('readonly', true);
            //             $('#supplierid').attr('disabled', 'disabled');
            //             $('#btnSavePo').attr('hidden', true);
            //             $('#btnProcess').attr('hidden', false);

            //             $('#btnAddDetail').removeAttr('disabled');
            //             // document.getElementById("btnSavePo").innerHTML = 'Process PO';
            //             // $('#btnSavePo').html('Process PO');
            //             // viewdata();
            //         }
            //     },
            //     error: function(xhr, ajaxOptions, thrownError) {
            //         alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            //     }
            // });
            // return false;
        });
    }

    // function poProcess() {
    //     $('#frmAddPo').submit(function(e) {
    //         $('#btnEnable').click();
    //         e.preventDefault();
    //         $.ajax({
    //             type: "post",
    //             url: "<?= base_url('po/updatePo') ?>",
    //             data: new FormData(this), //$(this).serialize(),
    //             dataType: "json",
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             beforeSend: function(xhr) {
    //                 $('#btnProcess').attr('disable', 'disable');
    //                 $('#btnProcess').html('<i class="fa fa-spin fa-spinner"</i>');
    //             },
    //             complete: function() {
    //                 $('#btnProcess').removeAttr('disable');
    //                 $('#btnProcess').html('Process PO');
    //             },
    //             success: function(response) {
    //                 if (response.error) {
    //                     // alert("Form Submited Successfully");
    //                     // Validasi---------------------------------------
    //                     if (response.error.potype) {
    //                         $('#potype').addClass('is-invalid');
    //                         $('#errorPoType').html(response.error.potype);

    //                         $('#btnEnable').click();
    //                         $('#btnProcess').click();
    //                     } else {
    //                         $('#potype').removeClass('is-invalid');
    //                         $('#errorPoType').html('');
    //                     }

    //                     if (response.error.pono) {
    //                         $('#pono').addClass('is-invalid');
    //                         $('#errorPoNo').html(response.error.pono);
    //                         getPONO();
    //                         $('#pono').removeClass('is-invalid');
    //                         $('#errorPoNo').html('');
    //                         $('#btnSavePo').click();
    //                     } else {
    //                         $('#pono').removeClass('is-invalid');
    //                         $('#errorPoNo').html('');

    //                         $('#btnEnable').click();
    //                         $('#btnProcess').click();
    //                     }

    //                     if (response.error.supplierid) {
    //                         $('#supplierid').addClass('is-invalid');
    //                         $('#errorSupplier').html(response.error.supplierid);
    //                     } else {
    //                         $('#supplierid').removeClass('is-invalid');
    //                         $('#errorSupplier').html('');
    //                     }
    //                     // endValidasi------------------------------------
    //                 } else {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'Success',
    //                         text: response.sukses,
    //                         showConfirmButton: false,
    //                         timer: 1500
    //                     })
    //                     // getPO();

    //                     $('#potype').removeAttr('is-invalid');
    //                     $('#pono').removeAttr('is-invalid');
    //                     $('#supplierid').removeAttr('is-invalid');

    //                     $('#potype').removeAttr('disabled');
    //                     $('#pono').attr('readonly', false);
    //                     $('#supplierid').removeAttr('disabled');
    //                     $('#btnSavePo').attr('hidden', false);
    //                     $('#btnProcess').attr('hidden', true);

    //                     $('#btnAddDetail').attr('disabled', 'disabled');
    //                     // document.getElementById("btnSavePo").innerHTML = 'Process PO';
    //                     // $('#btnSavePo').html('Process PO');
    //                     // viewdata();
    //                     $("#frmAddPoDetail").trigger("reset");
    //                     $("#frmAddPo").trigger("reset");

    //                     var table = $('#example').DataTable();
    //                     table.clear();
    //                     table.draw();
    //                 }
    //             },
    //             error: function(xhr, ajaxOptions, thrownError) {
    //                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //             }
    //         });
    //         return false;
    //     });
    // }

    // PO Detail
    function getItemName() {
        $("#additemname").val($("#additemcode option:selected").text());
    }

    function calculate() {
        var qty;
        var price;
        var total;
        qty = parseFloat($("#addqtyprice").val());
        price = parseFloat($("#addprice").val());
        total = qty * price;
        $("#addtotal").val(total.toFixed(4));
    }

    function podetailSave() {
        $('#frmAddPoDetail').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('po/savePoDetail') ?>",
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(xhr) {
                    $('#btnSavePoDetail').attr('disable', 'disable');
                    $('#btnSavePoDetail').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnSavePoDetail').removeAttr('disable');
                    $('#btnSavePoDetail').html('Create PO');
                },
                success: function(response) {
                    if (response.error) {} else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#modaladd").modal('hide');
                        ViewDataTablePoDetail();
                        getPOSUM();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    }

    function podetailEdit(id) {
        $.ajax({
            url: "<?= base_url('po/getpodetail') ?>",
            type: "GET",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(id, poid, itemcode, itemname, qty, unit, qty2, unit2, qtyprice, qtypriceunit, price, total) {
                    $('#modaledit').modal('show');
                    $('#editid').val(value = data.id);
                    $('#editpoid').val(value = data.poid);
                    $('#edititemcode').val(value = data.itemcode);
                    $('#edititemname').val(value = data.itemname);
                    $('#editqty1').val(value = data.qty);
                    $('#editunit1').val(value = data.unit);
                    $('#editqty2').val(value = data.qty2);
                    $('#editunit2').val(value = data.unit2);
                    $('#editqtyprice').val(value = data.qtyprice);
                    $('#editpriceunit').val(value = data.qtypriceunit);
                    $('#editprice').val(value = data.price);
                    $('#edittotal').val(value = data.total);
                });
            }
        });
    }

    function podetailRemove(id) {
        Swal.fire({
            title: 'Delete',
            text: "Are you sure delete item po ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/po/deletePoDetail",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            viewdata();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection(); ?>