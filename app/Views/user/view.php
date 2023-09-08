<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="mt-3"><?= $title; ?></h5>
        <!-- <button type="button" id="btnAdd" class="btn btn-primary btn-sm mt-3 mb-3"> <i class="fa-solid fa-circle-plus fa-xl"></i>&nbsp;Add</button> -->

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive small">
            <table id="tbuser" name="tbuser" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbUserData">
                </tbody>
                <!-- <tbody>
                    <//?php $i = 1; ?>
                    <//?php foreach ($user as $t) : ?>
                        <tr>
                            <th><//?= $i++; ?></th>
                            <td><img src="/img/users/<//?= $t->userimg; ?>" alt="" class="sampul"></td>
                            <td><//?= $t->username; ?></td>
                            <td><//?= $t->email; ?></td>
                            <td><//?= $t->name; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" onclick="edit('<//?= $t->userid; ?>')"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="remove('<//?= $t->userid; ?>')"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                            </td>
                        </tr>
                    <//?php endforeach; ?>
                </tbody> -->
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        var dataTableUser;
        ViewDataTable();
        Add();
    });

    function ViewDataTable() {
        dataTableUser = $('#tbuser').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('users/loadlistuser') ?>",
                type: "POST",
            },
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            // "scrollX": true,
            // "autoWidth": true,
            // "bLengthChange": false,
            // "pageLength": 5
        });
    }

    function Add() {
        $('#btnAdd').click(function(e) {
            e.preventDefault();
            let timerInterval
            Swal.fire({
                title: 'Load Form Add user',
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
            $.ajax({
                url: "/user/create",
                dataType: "json",
                success: function(response) {
                    $('.formaksi').html(response.create).show();
                    $('.formview').html(response.view).hide();

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    }

    function edit(userid) {
        $.ajax({
            type: "post",
            url: "/users/edit",
            data: {
                userid: userid
            },
            dataType: "json",
            success: function(response) {
                $('.formaksi').html(response.edit).show();
                $('.formview').html(response.view).hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function remove(id) {
        Swal.fire({
            title: 'Delete',
            text: "Are you sure delete user ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/user/delete",
                    data: {
                        userid: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            viewdata();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }
</script>