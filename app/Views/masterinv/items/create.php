<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center">Form Add Items</h3>
    </div>
    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAdditems">
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
                            <select class="form-control form-control-sm" aria-label="Default select example" id="material" name="material" onchange="createitems()">
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
                            <select class="form-control form-control-sm" aria-label="Default select example" id="materialtype" name="materialtype" onchange="createitems()">
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
                            <select class="form-control form-control-sm" aria-label="Default select example" id="colour" name="colour" onchange="createitems()">
                                <option selected>Open this select</option>
                                <?php foreach ($colour as $t) : ?>
                                    <option value="<?= $t['colourcode']; ?>"><?= $t['colourname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemsize" class="control-label col-sm-4" align="right">item Size</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemsize" name="itemsize" value="0000000" minlength="7" maxlength="7" onchange="createitems()">
                            <div class="invalid-feedback" id="errorSize"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unitsize" class="control-label col-sm-4" align="right">Size Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unitsize" name="unitsize" onchange="createitems()">
                                <option selected>Open this select</option>
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
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemcode" name="itemcode" value="XXX" autofocus>
                            <div class="invalid-feedback" id="errorCode"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="itemname" class="control-label col-sm-4" align="right">item Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="itemname" name="itemname" value="XXX">
                            <div class="invalid-feedback" id="errorName"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="unit" class="control-label col-sm-4" align="right">Item Unit</label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" aria-label="Default select example" id="unit" name="unit">
                                <option selected>Open this select</option>
                                <option value="PCS">PCS</option>
                                <option value="SET">SET</option>
                                <option value="BOX">BOX</option>
                                <option value="LTR">LTR</option>
                                <option value="ROL">ROLL</option>
                                <option value="RIM">RIM</option>
                                <option value="MX">M</option>
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
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        itemsSave();
        back();
        // createitemcode();
    });

    function previewImg() {
        const productPic = document.querySelector('#itemimg')
        const productPicLabel = document.querySelector('.custom-file-label');
        const productPicPreview = document.querySelector('.img-preview');

        productPicLabel.textContent = productPic.files[0].name;

        const filePicture = new FileReader();
        filePicture.readAsDataURL(productPic.files[0]);

        filePicture.onload = function(e) {
            productPicPreview.src = e.target.result;
        }
    }

    function itemsSave() {
        $('#frmAdditems').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/items/save",
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
                        if (response.error.itemcode) {
                            $('#itemcode').addClass('is-invalid');
                            $('#errorCode').html(response.error.itemcode);
                        } else {
                            $('#itemcode').removeClass('is-invalid');
                            $('#errorCode').html('');
                        }

                        if (response.error.itemname) {
                            $('#itemname').addClass('is-invalid');
                            $('#errorName').html(response.error.itemname);
                        } else {
                            $('#itemname').removeClass('is-invalid');
                            $('#errorName').html('');
                        }

                        if (response.error.itemimg) {
                            $('#itemimg').addClass('is-invalid');
                            $('#errorImg').html(response.error.itemimg);
                        } else {
                            $('#itemimg').removeClass('is-invalid');
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
                url: "/items/loaddata",
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

    function createitems() {
        // $("#category").change(function() {

        var Category;
        var Material;
        var MaterialType;
        var Colour;
        var Size;
        var SizeUnit;

        var CategoryName;
        var MaterialName;
        var MaterialTypeName;
        var ColourName;
        var SizeName;
        var SizeUnitName;

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

        var a = $("#itemsize").val().length;
        if ((a >= 1) && (a < 2)) {
            Size = '000000' + $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        } else if ((a >= 2) && (a < 3)) {
            Size = '00000' + $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        } else if ((a >= 3) && (a < 4)) {
            Size = '0000' + $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        } else if ((a >= 4) && (a < 5)) {
            Size = '000' + $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        } else if ((a >= 5) && (a < 6)) {
            Size = '00' + $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        } else if ((a >= 6) && (a < 7)) {
            Size = '0' + $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        } else if ((a >= 7) && (a < 8)) {
            Size = $("#itemsize").val();
            SizeName = $("#itemsize").val();
            //alert(a);
        }
        // }

        if ($("#unitsize").val() == 'Open this select') {
            SizeUnit = 'XX';
            SizeUnitName = '';
        } else {
            SizeUnit = $("#unitsize").val()
            SizeUnitName = $("#unitsize option:selected").text();
        }

        var itemcode = Category + Material + MaterialType + Colour + Size + SizeUnit;
        var itemname = CategoryName + MaterialName + MaterialTypeName + ColourName + SizeName + SizeUnitName;
        // alert("The text has been changed.");
        $("#itemcode").val(itemcode.trim());
        $("#itemname").val(itemname.trim());
        // });
    }
</script>