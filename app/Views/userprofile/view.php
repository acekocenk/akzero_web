<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="mt-3"><?= $title; ?></h5>
    </div>
    <div class="card-body">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row">
                <div class="col-md-4 mt-4">
                    <img src="<?= base_url('/img/users/' . $user->userimg); ?>" class="img-fluid rounded-start" alt="<?= $user->username; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5 class="card-title"> <?= $user->username; ?></h5>
                            </li>
                            <?php if ($user->fullname) : ?>
                                <li class="list-group-item"><?= $user->fullname; ?></li>
                            <?php endif; ?>
                            <li class="list-group-item"><?= $user->email; ?></li>
                            <li class="list-group-item">
                                <span class="badge badge-<?= ($user->name == 'admin') ? 'success' : 'warning' ?>"><?= $user->name; ?></span>
                            </li>
                            <!-- <li class="list-group-item"> -->
                            <!-- <a href="<//?= base_url('/'); ?>">&laquo; back</a> -->
                            <!-- </li> -->
                        </ul>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-sm">Edit</button>
                        <button type="button" class="btn btn-primary btn-sm">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        ViewDataTable();
        Add();
    });

    function ViewDataTable() {
        $('#tbuser').DataTable({
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
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

    function edit(slug) {
        $.ajax({
            type: "post",
            url: "/user/edit",
            data: {
                slug: slug
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