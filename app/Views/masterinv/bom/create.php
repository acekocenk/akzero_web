<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center">Form Add Bill Of Material</h3>
    </div>
    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAddBom">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <!-- <hr> -->
                    <div class="row mb-3">
                        <label for="category" class="control-label col-sm-4" align="right">Category</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="category" name="category" onchange="createBom()">
                                <option selected>Open this select</option>
                                <?php foreach ($category as $t) : ?>
                                    <option value="<?= $t['categorycode']; ?>"><?= $t['categoryname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="material" class="control-label col-sm-4" align="right">Material</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="material" name="material" onchange="createBom()">
                                <option selected>Open this select</option>
                                <?php foreach ($material as $t) : ?>
                                    <option value="<?= $t['materialcode']; ?>"><?= $t['materialname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="materialtype" class="control-label col-sm-4" align="right">Material Type</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="materialtype" name="materialtype" onchange="createBom()">
                                <option selected>Open this select</option>
                                <?php foreach ($materialtype as $t) : ?>
                                    <option value="<?= $t['materialtypecode']; ?>"><?= $t['materialtypename']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colour" class="control-label col-sm-4" align="right">Colour</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="colour" name="colour" onchange="createBom()">
                                <option selected>Open this select</option>
                                <?php foreach ($colour as $t) : ?>
                                    <option value="<?= $t['colourcode']; ?>"><?= $t['colourname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colour" class="control-label col-sm-4" align="right">BOM Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="bomcode" name="bomcode" value="XXX" autofocus>
                            <div class="invalid-feedback" id="errorCode"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colour" class="control-label col-sm-4" align="right">BOM Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="bomname" name="bomname" value="XXX">
                            <div class="invalid-feedback" id="errorName"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unit" class="control-label col-sm-4" align="right">Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unit" name="unit">
                                <option selected>Open this select</option>
                                <option value="PCS">PCS</option>
                                <option value="SET">SET</option>
                                <option value="M">METER</option>
                                <option value="CM">CM</option>
                                <option value="SQM">SQM</option>
                                <option value="KG">KG</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="bomimg" class="control-label col-sm-4" align="right">BOM Image</label>
                        <div class="col-sm-4">
                            <img src="/img/bom/default.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="bomimg" name="bomimg" onchange="previewImg()">
                                <div class="invalid-feedback" id="errorImg"></div>
                                <label class="custom-file-label  col-form-label-sm" for="bomimg">Img...</label>
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
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        bomSave();
        back();
        // createBomcode();
    });

    function previewImg() {
        const productPic = document.querySelector('#bomimg')
        const productPicLabel = document.querySelector('.custom-file-label');
        const productPicPreview = document.querySelector('.img-preview');

        productPicLabel.textContent = productPic.files[0].name;

        const filePicture = new FileReader();
        filePicture.readAsDataURL(productPic.files[0]);

        filePicture.onload = function(e) {
            productPicPreview.src = e.target.result;
        }
    }

    function bomSave() {
        $('#frmAddBom').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/bom/save",
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#btnsave').attr('disable', 'disable');
                    $('#btnsave').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnsave').removeAttr('disable');
                    $('#btnsave').html('Save');
                },
                success: function(response) {
                    if (response.error) {
                        // alert("Form Submited Successfully");
                        // Validasi---------------------------------------
                        if (response.error.bomcode) {
                            $('#bomcode').addClass('is-invalid');
                            $('#errorCode').html(response.error.bomcode);
                        } else {
                            $('#bomcode').removeClass('is-invalid');
                            $('#errorCode').html('');
                        }

                        if (response.error.bomname) {
                            $('#bomname').addClass('is-invalid');
                            $('#errorName').html(response.error.bomname);
                        } else {
                            $('#bomname').removeClass('is-invalid');
                            $('#errorName').html('');
                        }

                        if (response.error.bomimg) {
                            $('#bomimg').addClass('is-invalid');
                            $('#errorImg').html(response.error.bomimg);
                        } else {
                            $('#bomimg').removeClass('is-invalid');
                            $('#errorImg').html('');
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
                url: "/bom/loaddata",
                dataType: "json",
                success: function(response) {
                    $('.formaksi').html(response.create).hide();
                    viewdata();
                    let timerInterval
                    Swal.fire({
                        title: 'Load Bill Of Material',
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

    function createBom() {
        // $("#category").change(function() {

        var Category;
        var Material;
        var MaterialType;
        var Colour;

        var CategoryName;
        var MaterialName;
        var MaterialTypeName;
        var ColourName;

        if ($("#category").val() == 'Open this select') {
            Category = 'XXX';
            CategoryName = '';
        } else {
            Category = $("#category").val();
            CategoryName = $("#category option:selected").text();
        }

        if ($("#material").val() == 'Open this select') {
            Material = 'XXX';
            MaterialName = '';
        } else {
            Material = $("#material").val();
            MaterialName = $("#material option:selected").text();
        }

        if ($("#materialtype").val() == 'Open this select') {
            MaterialType = 'X0X0';
            MaterialTypeName = '';
        } else {
            MaterialType = $("#materialtype").val();
            MaterialTypeName = $("#materialtype option:selected").text();
        }

        if ($("#colour").val() == 'Open this select') {
            Colour = 'XXX';
            ColourName = '';
        } else {
            Colour = $("#colour").val();
            ColourName = $("#colour option:selected").text();
        }

        var BomCode = Category + Material + MaterialType + Colour;
        var BomName = CategoryName + MaterialName + MaterialTypeName + ColourName;
        // alert("The text has been changed.");
        $("#bomcode").val(BomCode);
        $("#bomname").val(BomName.trim());
        // });
    }
</script>