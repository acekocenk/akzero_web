<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 align="center">Form Edit Colour</h3>
    </div>
    <div class="card-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmEditcolour">
            <?= csrf_field(); ?>
            <input type="hidden" id="id" name="id" value="<?= $colour['id']; ?>">
            <input type="hidden" id="slug" name="slug" value="<?= $colour['slug']; ?>">
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <!-- <hr> -->
                    <div class="row mb-3">
                        <label for="colourcode" class="control-label col-sm-4" align="right">Colour Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="colourcode" name="colourcode" value="<?= $colour['colourcode']; ?>" autofocus>
                            <div class="invalid-feedback" id="errorCode"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="colourname" class="control-label col-sm-4" align="right">Colour Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="colourname" name="colourname" value="<?= $colour['colourname']; ?>">
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
</div>
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        colourUpdate();
        back();
    });

    function colourUpdate() {
        $('#frmEditcolour').submit(function(e) {
            e.preventDefault();
            // var ColourId = $('#id').val();
            // var ColourCode = $('#colourcode').val();
            // var ColourName = $('#colourname').val();
            // var Slug = $('#slug').val();
            $.ajax({
                type: "post",
                url: "/colour/update",
                data: $(this).serialize(),
                // data: {
                //     id: ColourId,
                //     colourcode: ColourCode,
                //     colourname: ColourName,
                //     slug: Slug
                // },
                dataType: "json",
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
                        if (response.error.colourcode) {
                            $('#colourcode').addClass('is-invalid');
                            $('#errorCode').html(response.error.colourcode);
                        } else {
                            $('#colourcode').removeClass('is-invalid');
                            $('#errorCode').html('');
                        }

                        if (response.error.colourname) {
                            $('#colourname').addClass('is-invalid');
                            $('#errorName').html(response.error.colourname);
                        } else {
                            $('#colourname').removeClass('is-invalid');
                            $('#errorName').html('');
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
                url: "/colour/loaddata",
                dataType: "json",
                success: function(response) {
                    $('.formaksi').html(response.create).hide();
                    viewdata();
                    let timerInterval
                    Swal.fire({
                        title: 'Load colour',
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