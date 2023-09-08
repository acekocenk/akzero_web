<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center">Form Edit User</h3>
    </div>

    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmEditUser">
            <?= csrf_field(); ?>
            <input type="hidden" id="userid" name="userid" value="<?= $user->userid; ?>">
            <input type="hidden" name="userimgLama" value="<?= $user->userimg; ?>">
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <div class="row mb-3">
                        <label for="userimg" class="control-label col-sm-4" align="right">User Image</label>
                        <div class="col-sm-4">
                            <img src="/img/users/<?= $user->userimg; ?>" class="img-thumbnail img-preview">
                        </div>
                        <!-- <div class="col-sm-4">

                        </div> -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="userimg" name="userimg" value="<?= old($user->userimg); ?>" onchange="previewImg()">
                                <div class="invalid-feedback" id="errorImg"></div>
                                <label class="custom-file-label col-form-label-sm" for="userimg"><?= $user->userimg; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fullname" class="control-label col-sm-4" align="right">Full Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="userfullname" name="userfullname" value="<?= $user->fullname; ?>">
                            <!-- <div class=" invalid-feedback" id="errorCode"> -->
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="control-label col-sm-4" align="right">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="useremail" name="useremail" value="<?= $user->email; ?>" readonly>
                        <!-- <div class=" invalid-feedback" id="errorCode"> -->
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="username" class="control-label col-sm-4" align="right">Username</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="userusername" name="userusername" value="<?= $user->username; ?>" readonly>
                    <!-- <div class=" invalid-feedback" id="errorCode"> -->
                </div>
            </div>
    </div>
    <div class="row mb-3">
        <label for="group" class="control-label col-sm-4" align="right">Group</label>
        <div class="col-sm-8">
            <select class="form-control form-control-sm" aria-label="Default select example" id="group" name="group">
                <option selected>Open this select</option>
                <?php foreach ($groups as $t) : ?>
                    <option value="<?= $t->id; ?>" <?= $t->id == $user->groupsid ? "selected" : null; ?>><?= $t->name; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="box-footer" align="right">
        <button type="submit" class="btn btn-primary" id="btnUpdate"><i class="fa-solid fa-check"></i>&nbsp;Update</button>
        <button class="btn btn-danger" id="btnCancel"><i class="fa-solid fa-xmark"></i>&nbsp;Cancel</button>
        <!-- <input type="submit" name="submit" class="btn btn-primary" value="Register Data">
                            <a href="../mhs/mhs_home.php" class="btn btn-danger">Batal</a> -->
    </div>
    <div class="col-lg-3">
    </div>
</div>
</form>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        update();
        back();
    });

    function previewImg() {
        const productPic = document.querySelector('#userimg')
        const productPicLabel = document.querySelector('.custom-file-label');
        const productPicPreview = document.querySelector('.img-preview');

        productPicLabel.textContent = productPic.files[0].name;

        const filePicture = new FileReader();
        filePicture.readAsDataURL(productPic.files[0]);

        filePicture.onload = function(e) {
            productPicPreview.src = e.target.result;
        }
    }

    function Update() {
        $('#frmEditUser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/users/update",
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
                        // if (response.error.bomcode) {
                        //     $('#bomcode').addClass('is-invalid');
                        //     $('#errorCode').html(response.error.bomcode);
                        // } else {
                        //     $('#bomcode').removeClass('is-invalid');
                        //     $('#errorCode').html('');
                        // }

                        // if (response.error.bomname) {
                        //     $('#bomname').addClass('is-invalid');
                        //     $('#errorName').html(response.error.bomname);
                        // } else {
                        //     $('#bomname').removeClass('is-invalid');
                        //     $('#errorName').html('');
                        // }

                        if (response.error.userimg) {
                            $('#userimg').addClass('is-invalid');
                            $('#errorImg').html(response.error.userimg);
                        } else {
                            $('#userimg').removeClass('is-invalid');
                            $('#errorImg').html('');
                        }
                        // endValidasi------------------------------------
                    } else {
                        $('.formaksi').html(response.edit).hide();
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
                url: "/users/loaddata",
                dataType: "json",
                success: function(response) {
                    $('.formaksi').html(response.create).hide();
                    viewdata();
                    let timerInterval
                    Swal.fire({
                        title: 'Load Users',
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