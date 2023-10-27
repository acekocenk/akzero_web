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
            <table id="tbBom" name="tbBom" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>BOM Image</th>
                        <th>BOM Code</th>
                        <th>BOM Name</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbBomData">
                </tbody>
                <!-- <tbody>
                    <//?php $i = 1; ?>
                    <//?php foreach ($bom as $t) : ?>
                        <tr>
                            <th><//?= $i++; ?></th>
                            <td><img src="/img/bom/<//?= $t['bomimg']; ?>" alt="" class="sampul"></td>
                            <td><//?= $t['bomcode']; ?></td>
                            <td><//?= $t['bomname']; ?></td>
                            <td><//?= $t['unit']; ?></td>
                            <td>
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
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        var dataTableBOM;
        ViewDataTable();
        Add();
    });

    function ViewDataTable2() {
        Swal.fire({
            title: 'BOE Loading.......',
            icon: 'info',
            timer: 3000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading(Swal.getDenyButton())
                dataTableBOM = $('#tbBom').DataTable({
                    // "processing": true,
                    // "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "<?= base_url('bom/ajaxloadbom') ?>",
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
        });
    }

    function ViewDataTable() {
        dataTableBOM = $('#tbBom').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('bom/loadlistbom') ?>",
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
            $.ajax({
                url: "/bom/create",
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
            url: "/bom/edit",
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
            text: "Are you sure delete Bom ?",
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
                    url: "/bom/delete",
                    data: {
                        Bomid: id
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
                            // viewdata();
                            dataTableBOM.ajax.reload();
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