<div class="row">
    <div class="col-md-12">
        <!-- <a href="/product/create" class="btn btn-primary mt-3 mb-3">Add supplier</a> -->
        <h5 class="mt-3"><?= $title; ?></h5>
        <button type="button" id="btnAdd" class="btn btn-primary btn-sm mt-3 mb-3"> <i class="fa-solid fa-circle-plus fa-xl"></i>&nbsp;Add</button>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <table id="tbsupplier" name="tbsupplier" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Address</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th>Acc Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($supplier as $t) : ?>
                    <tr>
                        <th><?= $i++; ?></th>
                        <td><?= $t['suppliername']; ?></td>
                        <td><?= $t['address']; ?></td>
                        <td><?= $t['telp']; ?></td>
                        <td><?= $t['email']; ?></td>
                        <td><?= $t['acccode']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="edit('<?= $t['slug']; ?>')"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="remove('<?= $t['id']; ?>')"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        ViewDataTable();
        Add();
    });

    function ViewDataTable() {
        $('#tbsupplier').DataTable({
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
                title: 'Load Form Add Supplier',
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
                url: "/supplier/create",
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
            url: "/supplier/edit",
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
            text: "Are you sure delete supplier ?",
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
                    url: "/supplier/delete",
                    data: {
                        supplierid: id
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