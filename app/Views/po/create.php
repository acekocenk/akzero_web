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
                        <div class="row mb-3">
                            <div class="col">
                                <label from="" class="control-label">PO Type</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="potype" name="potype" onchange="getPONO()">
                                    <option selected></option>
                                    <option value="Local">Local</option>
                                    <option value="Import">Import</option>
                                </select>
                                <div class="invalid-feedback" id="errorPoType"></div>
                            </div>
                            <div class="col">
                                <label from="" class="control-label">PO NO</label>
                                <input class="form-control form-control-sm" id="pono" name="pono" type="input">
                                <div class="invalid-feedback" id="errorPoNo"></div>
                            </div>
                            <div class="col">
                                <label from="supplier" class="control-label">Supplier</label>
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
                                <label from="" class="control-label">PO Date</label>
                                <input class="form-control form-control-sm" id="podate" name="podate" type="date">
                            </div>
                            <div class="col">
                                <label from="" class="control-label">PO Date In</label>
                                <input class="form-control form-control-sm" id="indate" name="indate" type="date">
                            </div>
                            <div class="col">
                                <label from="currency" class="control-label">Currency</label>
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
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnSave"><i class="fa-solid fa-check"></i>&nbsp;Create PO</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnProcess" hidden="true"><i class="fa-solid fa-check"></i>&nbsp;Process PO</button>
                                    <a class="btn btn-danger btn-sm" href="#" role="button" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</a>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <div class="col">
                                <label for="unit" class="control-label col-sm" align="right">Item Unit</label>
                                <input class="form-control" id="demo" value="jQuery">
                            </div>
                        </div> -->
                        <div class="formviewpodetail">
                            <button type="button" id="btnAddDetail" class="btn btn-primary btn-sm mt-3 mb-3" data-toggle="modal" data-target="#modaladd" disabled> <i class="fa-solid fa-circle-plus fa-xl"></i>&nbsp;Add</button>
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
                                <label for="itemname" class="control-label col-sm-8" align="right">Discount</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" id="discount" name="discount" value="0">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                                <label for="itemname" class="control-label col-sm-2">%</label>
                            </div>
                            <div class="row">
                                <label for="itemname" class="control-label col-sm-8" align="right">PPN</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" id="ppn" name="ppn" value="0">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                                <label for="itemname" class="control-label col-sm-2">%</label>
                            </div>
                            <div class="row">
                                <label for="itemname" class="control-label col-sm-8" align="right">Grand Total</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control form-control-sm" id="grandtotal" name="grandtotal" value="0">
                                    <div class="invalid-feedback" id="errorName"></div>
                                </div>
                                <label for="itemname" class="control-label col-sm-2">%</label>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
                <label for="unit" class="control-label col-sm" align="right">Item Unit</label>
                <input class="form-control" id="demo" value="jQuery">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--END MODAL ADD-->
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        // $('.formviewpodetail').show();
        $('#btnAddDetail').removeAttr('disabled');
        ViewDataTablePoDetail();
        getDate();
        poSave();

        $('#demo').inputpicker({
            url: "<?= base_url('po/getItems') ?>",
            fields: ['itemcode', 'itemname', 'hscode'],
            fieldText: 'itemname',
            fieldValue: 'itemcode',
            filterOpen: true,
            headShow: true,
            pageMode: '',
            pageField: 'p',
            pageLimitField: 'per_page',
            limit: 5,
            pageCurrent: 1,
        });
        // $('#demo').inputpicker({
        //     data: [{
        //             value: "1",
        //             text: "jQuery",
        //             description: "This is the description of the text 1."
        //         },
        //         {
        //             value: "2",
        //             text: "Script",
        //             description: "This is the description of the text 2."
        //         },
        //         {
        //             value: "3",
        //             text: "Net",
        //             description: "This is the description of the text 3."
        //         }
        //     ],
        //     fields: [{
        //             name: 'value',
        //             text: 'Id'
        //         },
        //         {
        //             name: 'text',
        //             text: 'Title'
        //         },
        //         {
        //             name: 'description',
        //             text: 'Description'
        //         }
        //     ],
        //     headShow: true,
        //     fieldText: 'text',
        //     fieldValue: 'value'
        // });
    });

    function ViewDataTablePoDetail() {
        var pono = $("#pono").val();
        dataTablePO = $('#tbPODeatil').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('po/loadlistpo_detail') ?>",
                type: "POST",
                data: {
                    pono: pono
                },
                dataType: "json",
            },
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            // "scrollX": true,
            "autoWidth": true,
            // "bLengthChange": false,
            // "pageLength": 5
            // "ordering": false,
        });
    }

    function getPONO() {
        var potype = $("#potype").val();
        $.ajax({
            url: "<?= base_url('po/getpono') ?>",
            type: "POST",
            data: {
                potype: potype
            },
            dataType: "json",
            success: function(response) {
                if (response.pono) {
                    document.getElementById("pono").value = response.pono;
                } else {
                    document.getElementById("pono").value = "";
                }
            }
        });

        ViewDataTablePoDetail();
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

    function poSave() {
        $('#frmAddPo').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('po/save') ?>",
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(xhr) {
                    $('#btnSave').attr('disable', 'disable');
                    $('#btnSave').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnSave').removeAttr('disable');
                    $('#btnSave').html('Create PO');
                },
                success: function(response) {
                    if (response.error) {
                        // alert("Form Submited Successfully");
                        // Validasi---------------------------------------
                        if (response.error.potype) {
                            $('#potype').addClass('is-invalid');
                            $('#errorPoType').html(response.error.potype);
                        } else {
                            $('#potype').removeClass('is-invalid');
                            $('#errorPoType').html('');
                        }

                        if (response.error.pono) {
                            $('#pono').addClass('is-invalid');
                            $('#errorPoNo').html(response.error.pono);
                            getPONO();
                            $('#pono').removeClass('is-invalid');
                            $('#errorPoNo').html('');
                            $('#btnSave').click();
                        } else {
                            $('#pono').removeClass('is-invalid');
                            $('#errorPoNo').html('');
                        }

                        if (response.error.supplierid) {
                            $('#supplierid').addClass('is-invalid');
                            $('#errorSupplier').html(response.error.supplierid);
                        } else {
                            $('#supplierid').removeClass('is-invalid');
                            $('#errorSupplier').html('');
                        }
                        // endValidasi------------------------------------
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#potype').attr('disabled', 'disabled');
                        $('#pono').attr('disabled', 'disabled');
                        $('#supplierid').attr('disabled', 'disabled');
                        $('#btnSave').attr('hidden', true);
                        $('#btnProcess').attr('hidden', false);

                        $('#btnAddDetail').removeAttr('disabled');
                        // document.getElementById("btnSave").innerHTML = 'Process PO';
                        // $('#btnSave').html('Process PO');
                        // viewdata();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    }

    function processPO() {}
</script>
<?= $this->endSection(); ?>