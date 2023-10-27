<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        itemsSave();
        itemsUpdate();
        back();
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
        $('#frmAdditem').submit(function(e) {
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

                        if (response.error.itemsize) {
                            $('#itemsize').addClass('is-invalid');
                            $('#errorSize').html(response.error.itemsize);
                        } else {
                            $('#itemsize').removeClass('is-invalid');
                            $('#errorSize').html('');
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

    function itemsUpdate() {
        $('#frmEditItem').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('/items/update') ?>",
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#btnUpdate').attr('disable', 'disable');
                    $('#btnUpdate').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnUpdate').removeAttr('disable');
                    $('#btnUpdate').html('Update');
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

                        if (response.error.itemsize) {
                            $('#itemsize').addClass('is-invalid');
                            $('#errorSize').html(response.error.itemsize);
                        } else {
                            $('#itemsize').removeClass('is-invalid');
                            $('#errorSize').html('');
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
                        title: 'Load Items',
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

        if ($("#category").val() == 'XXX') {
            Category = 'XXX';
            CategoryName = '';
        } else {
            Category = $("#category").val();
            CategoryName = $("#category option:selected").text();
        }

        if ($("#material").val() == 'XXX') {
            Material = 'XXX';
            MaterialName = '';
        } else {
            Material = $("#material").val();
            MaterialName = $("#material option:selected").text();
        }

        if ($("#materialtype").val() == 'X0X0') {
            MaterialType = 'X0X0';
            MaterialTypeName = '';
        } else {
            MaterialType = $("#materialtype").val();
            MaterialTypeName = $("#materialtype option:selected").text();
        }

        if ($("#colour").val() == 'XXX') {
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

        if ($("#itemsize").val() == '') {
            document.getElementById('itemsize').value = '0000000';
            Size = '0000000';
            SizeName = '';
        }

        if ($("#unitsize").val() == 'XX') {
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

    function createCodenName() {

    }
</script>