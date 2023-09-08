<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="mt-3"><?= $title; ?></h5>
        <button type="button" id="btnAdd" class="btn btn-primary btn-sm mt-3 mb-3"> <i class="fa-solid fa-circle-plus fa-xl"></i>&nbsp;Add</button>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive small">
            <table id="tbCategory" name="tbCategory" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Code</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- <tbody>
                <//?php $i = 1; ?>
                <//?php foreach ($category as $t) : ?>
                    <tr>
                        <th style="width:5%"><//?= $i++; ?></th>
                        <td style="width:20%"><//?= $t['categorycode']; ?></td>
                        <td style="width:57%"><//?= $t['categoryname']; ?></td>
                        <td style="width:18%">
                            <button type="button" class="btn btn-primary btn-sm" onclick="edit('<//?= $t['slug']; ?>')"><i class="fa-solid fa-file-pen"></i>&nbsp;Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="remove('<//?= $t['id']; ?>')"><i class="fa-solid fa-trash-can"></i>&nbsp;Delete</button>
                        </td>
                    </tr>
                <//?php endforeach; ?>
            </tbody> -->
            </table>
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

    function ViewDataTable2() {
        $('#tbCategory').DataTable({
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            // "bLengthChange": false,
            // "pageLength": 5
        });
    }

    function ViewDataTable() {
        dataTableBOM = $('#tbCategory').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('category/ajaxloadcategory') ?>",
                type: "POST",
            },
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            // "scrollX": true,
            // "autoWidth": true
            // "bLengthChange": false,
            // "pageLength": 5
        });
    }

    function Add() {
        $('#btnAdd').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/category/create",
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
            url: "/category/edit",
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
            text: "Are you sure delete category ?",
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
                    url: "/category/delete",
                    data: {
                        categoryid: id
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