<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 align="center">Form Edit Supplier</h2>
        </div>
        <div class="panel-body">
            <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmEditSupplier">
                <?= csrf_field(); ?>
                <input type="hidden" id="id" name="id" value="<?= $supplier['id']; ?>">
                <input type="hidden" id="slug" name="slug" value="<?= $supplier['slug']; ?>">
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <hr>
                        <div class="row mb-3">
                            <label for="suppliername" class="control-label col-sm-4" align="right">Supplier </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-capitalize" id="suppliername" name="suppliername" maxlength="50" value="<?= $supplier['suppliername']; ?>" autofocus>
                                <div class="invalid-feedback" id="errorSupplier"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="acccode" class="control-label col-sm-4" align="right">Acc Code</label>
                            <div class="col-sm-8">
                                <select class="custom-select" aria-label="Default select example" id="acccode" name="acccode">
                                    <option selected>Open this select menu</option>
                                    <?php foreach ($abipro as $t) : ?>
                                        <option value="<?= $t['H_KODE']; ?>" <?= $t['H_KODE'] == $supplier['acccode'] ? "selected" : null; ?>><?= $t['H_NAMA']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telp" class="control-label col-sm-4" align="right">Telp </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telp" name="telp" placeholder="888 888 8888" maxlength="25" value="<?= $supplier['telp']; ?>" />
                                <div class="invalid-feedback" id="errorTelp"></div>
                            </div>
                        </div>
                        <div class=" row mb-3">
                            <label for="email" class="control-label col-sm-4" align="right">Email </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email" maxlength="50" value="<?= $supplier['email']; ?>">
                                <div class="invalid-feedback" id="errorEmail"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="control-label col-sm-4" align="right">Address </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control text-capitalize" id="address" name="address" maxlength="100"><?= $supplier['address']; ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer" align="right">
                            <button type="submit" class="btn btn-primary" id="btnUpdate"><i class="fa-solid fa-check"></i>&nbsp;Update</button>
                            <button class="btn btn-danger" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        supplierUpdate();
        back();
    });

    function supplierUpdate() {
        $('#frmEditSupplier').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/supplier/Update",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#btnUpdate').attr('disable', 'disable');
                    $('#btnUpdate').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnUpdate').removeAttr('disable');
                    $('#btnUpdate').html('<i class="fa-solid fa-check"></i>&nbsp;Update');
                },
                success: function(response) {
                    if (response.error) {
                        // alert("Form Submited Successfully");
                        // Validasi---------------------------------------
                        if (response.error.suppliername) {
                            $('#suppliername').addClass('is-invalid');
                            $('#errorSupplier').html(response.error.suppliername);
                        } else {
                            $('#suppliername').removeClass('is-invalid');
                            $('#errorSupplier').html('');
                        }
                        if (response.error.telp) {
                            $('#telp').addClass('is-invalid');
                            $('#errorTelp').html(response.error.telp);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#errorEmail').html('');
                        }
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('#errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#errorEmail').html('');
                        }
                        // endValidasi------------------------------------
                    } else {
                        $('.formaksi').html(response.create).hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        viewdata();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    }

    function back() {
        $('#btnCancel').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/supplier/loaddata",
                dataType: "json",
                success: function(response) {
                    $('.formaksi').html(response.create).hide();
                    viewdata();
                    let timerInterval
                    Swal.fire({
                        title: 'Load List Supplier',
                        timer: 1000,
                        timerProgressBar: true,
                        willOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                                const content = Swal.getContent()
                                if (content) {
                                    const b = content.querySelector('b')
                                    if (b) {
                                        b.textContent = Swal.getTimerLeft()
                                    }
                                }
                            }, 100)
                        },
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    }
</script>