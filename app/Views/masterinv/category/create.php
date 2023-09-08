<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center">Form Add Category</h3>
    </div>
    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmAddCategory">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <!-- <hr> -->
                    <div class="row mb-3">
                        <label for="categorycode" class="control-label col-sm-4" align="right">Category Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="categorycode" name="categorycode" value="XXX" autofocus>
                            <div class="invalid-feedback" id="errorCode"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="categoryname" class="control-label col-sm-4" align="right">Category Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="categoryname" name="categoryname" value="XXX">
                            <div class="invalid-feedback" id="errorName"></div>
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
        CategorySave();
        back();
    });

    function CategorySave() {
        $('#frmAddCategory').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/category/save",
                data: $(this).serialize(),
                dataType: "json",
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
                        if (response.error.categorycode) {
                            $('#categorycode').addClass('is-invalid');
                            $('#errorCode').html(response.error.categorycode);
                        } else {
                            $('#categorycode').removeClass('is-invalid');
                            $('#errorCode').html('');
                        }

                        if (response.error.categoryname) {
                            $('#categoryname').addClass('is-invalid');
                            $('#errorName').html(response.error.categoryname);
                        } else {
                            $('#categoryname').removeClass('is-invalid');
                            $('#errorName').html('');
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
                url: "/category/loaddata",
                dataType: "json",
                success: function(response) {
                    $('.formaksi').html(response.create).hide();
                    viewdata();
                    let timerInterval
                    Swal.fire({
                        title: 'Load Category',
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