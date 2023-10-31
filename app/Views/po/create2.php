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
                                <label for="" class="control-label">PO Type</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="potype" name="potype" onchange="getPONO()">
                                    <option selected></option>
                                    <option value="Local">Local</option>
                                    <option value="Import">Import</option>
                                </select>
                                <div class="invalid-feedback" id="errorPoType"></div>
                            </div>
                            <div class="col">
                                <label for="" class="control-label">PO NO</label>
                                <input class="form-control form-control-sm" id="pono" name="pono" type="input">
                                <div class="invalid-feedback" id="errorPoNo"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="box-footer" align="right">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btnSave"><i class="fa-solid fa-check"></i>&nbsp;Create PO</button>

                                    <a class="btn btn-danger btn-sm" href="/po" role="button" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</a>
                                    <a class="btn btn-danger btn-sm" onclick="redirect()" role="button" id="btnRedirect" hidden="true"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        poSave();
    });

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
    }

    function redirect() { //from   w  ww  .j  a v a  2s  .c  o m
        var url = document.getElementById("pono").value;
        window.location.href = '/po/edit/' + url;
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
                        // getPO();

                        $('#potype').attr('disabled', 'disabled');
                        $('#pono').attr('disabled', 'disabled');
                        $('#btnRedirect').click();
                        // $('#supplierid').attr('disabled', 'disabled');
                        // $('#btnSave').attr('hidden', true);
                        // $('#btnProcess').attr('hidden', false);

                        // $('#btnAddDetail').removeAttr('disabled');
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
</script>
<?= $this->endSection(); ?>