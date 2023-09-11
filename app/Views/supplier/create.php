<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 align="center">Form Add Supplier</h2>
        </div>
        <div class="panel-body">
            <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAddSupplier">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <!-- <h3 align="center">Supplier</h3> -->
                        <hr>
                        <div class="row mb-3">
                            <label for="suppliername" class="control-label col-sm-4" align="right">Supplier </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-capitalize" id="suppliername" name="suppliername" maxlength="50" autofocus>
                                <div class="invalid-feedback" id="errorSupplier"></div>
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                            <label for="acccode" class="control-label col-sm-4" align="right">Acc Code </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-capitalize" id="acccode" name="acccode" maxlength="25">
                            </div>
                        </div> -->
                        <div class="row mb-3">
                            <label for="acccode" class="control-label col-sm-4" align="right">Acc Code</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select example" id="acccode" name="acccode">
                                    <option selected>Open this select</option>
                                    <?php foreach ($abipro as $t) : ?>
                                        <option value="<?= $t['H_KODE']; ?>"><?= $t['H_NAMA']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telp" class="control-label col-sm-4" align="right">Telp </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="telp" name="telp" placeholder="888 888 8888" maxlength="25" />
                                <div class="invalid-feedback" id="errorTelp"></div>
                            </div>
                        </div>
                        <div class=" row mb-3">
                            <label for="email" class="control-label col-sm-4" align="right">Email </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email" maxlength="50">
                                <div class="invalid-feedback" id="errorEmail"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="control-label col-sm-4" align="right">Address </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control text-capitalize" id="address" name="address" maxlength="100"></textarea>
                                <!-- <div class="invalid-feedback" id="errorCode"></div> -->
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-4" for="ktp_mhs">KTP </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ktp_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="nim_mhs">NIM </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nim_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="nama_mhs">Nama Lengkap </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="tgl_mhs">Tanggal Lahir </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tgl_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="tmplhr_mhs">Tempat Lahir </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tmplhr_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="agama_mhs">Agama </label>
                            <div class="col-sm-8"><select id="agama_mhs" class="form-control select2" style="width 100%;">
                                    <option value="-" selected="selected">---</option>
                                    <option value="muslim">Muslim</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                    <option value="konghucu">Konghucu</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="kwn_mhs">Kewarganegaraan </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kwn_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="jk_mhs">Jenis Kelamin </label>
                            <div class="col-sm-8"><select id="jk_mhs" class="form-control select2" style="width 100%;">
                                    <option value="-" selected="selected">---</option>
                                    <option value="L">Laki laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="almt_mhs">Alamat </label>
                            <div class="col-sm-8">
                                <textarea id="smk_almt" name="almt_mhs" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email_mhs">Email </label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email_mhs" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="notlp_mhs">No. Telepon </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="notlp_mhs" required>
                            </div>
                        </div> -->
                        <div class="box-footer" align="right">
                            <button type="submit" class="btn btn-primary" id="btnSave"><i class="fa-solid fa-check"></i>&nbsp;Save</button>
                            <button class="btn btn-danger" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
                            <!-- <input type="submit" name="submit" class="btn btn-primary" value="Register Data">
                            <a href="../mhs/mhs_home.php" class="btn btn-danger">Batal</a> -->
                        </div>
                    </div>
                    <!-- <div class="col-lg-6">
                        <div class="col-lg">
                            <h3>Data Alumni Mahasiswa</h3>
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="smak">SMA / SMK </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="smak" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="smak_almt">Alamat Sekolah </label>
                                <div class="col-sm-8">
                                    <textarea id="smak_almt" name="smak_almt" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="lulus">Lulus Tahun </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lulus" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <h3 style="margin-top 50px">Data Orang Tua Mahasiswa</h3>
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="nama_ortu">Nama Ayah / Ibu </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_ortu" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="notlp_ortu">No. Telepon </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="notlp_ortu" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="almt_ortu">Alamat Orang Tua </label>
                                <div class="col-sm-8">
                                    <textarea id="almt_ortu" name="almt_ortu" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-footer" style="margin-top 185px" align="right">
                                <input type="submit" name="submit" class="btn btn-primary" value="Register Data">
                                <a href="../mhs/mhs_home.php" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        supplierSave();
        back();
    });

    function supplierSave() {
        $('#frmAddSupplier').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/supplier/save",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#btnSave').attr('disable', 'disable');
                    $('#btnSave').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnSave').removeAttr('disable');
                    $('#btnSave').html('<i class="fa-solid fa-check"></i>&nbsp;Save');
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