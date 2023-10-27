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
            <table id="tbItem" name="tbItem" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Image</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbItemData">
                </tbody>
                <!-- <tbody>
                    <//?php $i = 1; ?>
                    <//?php foreach ($Item as $t) : ?>
                        <tr>
                            <th><//?= $i++; ?></th>
                            <td><img src="/img/items/<//?= $t['Itemimg']; ?>" alt="" class="sampul"></td>
                            <td><//?= $t['Itemcode']; ?></td>
                            <td><//?= $t['Itemname']; ?></td>
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
        var dataTableItem;
        ViewDataTable();
        add();
    });

    function ViewDataTable() {
        dataTableItem = $('#tbItem').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('items/loadlistitems') ?>",
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

    function add() {
        $('#btnAdd').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/items/create",
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

    function edit(itemcode) {
        $.ajax({
            type: "post",
            url: "/items/edit",
            data: {
                itemcode: itemcode
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
            text: "Are you sure delete Item ?",
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
                    url: "/items/delete",
                    data: {
                        itemid: id
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
                            dataTableItem.ajax.reload();
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