<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="mt-3"><?= $title; ?></h5>
        <a class="btn btn-primary btn-sm mt-3 mb-3" href="<?= base_url('po/createPo'); ?>" role="button"> <i class="fa-solid fa-circle-plus fa-xl"></i>&nbsp;Add</a>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="table-responsive small">
            <table id="tbPO" name="tbPO" class="table table-striped table-sm" width="150%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PO Type</th>
                        <th>PO No</th>
                        <th>PO Date</th>
                        <th>PO In Date</th>
                        <th>Currency</th>
                        <th>Supplier</th>
                        <th>Discount</th>
                        <th>PPN</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbPOData">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        var dataTablePO;
        ViewDataTable();
        Add();
    });

    function ViewDataTable() {
        dataTablePO = $('#tbPO').DataTable({
            "processing": true,
            // "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= base_url('po/loadlistpo') ?>",
                type: "POST",
            },
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            // "scrollX": true,
            "autoWidth": true,
            // "bLengthChange": false,
            // "pageLength": 5
            // "ordering": false,
        });
    }

    function Add() {
        $('#btnAdd').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "po/createPo",
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
            url: "/po/edit",
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
            text: "Are you sure delete PO ?",
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
                    url: "/po/delete",
                    data: {
                        POid: id
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
                            dataTablePO.ajax.reload();
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