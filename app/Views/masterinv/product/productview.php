<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/product/create" class="btn btn-primary mt-3 mb-3">Add Product</a>
            <h3 class="mt-3 mb-3 d-inline">View Product</h3>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table id="tbProduct" name="tbProduct" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="listProduct">
                    <?php $i = 1; ?>
                    <?php foreach ($product as $t) : ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><img src="/img/product/<?= $t['product_img']; ?>" alt="" class="sampul"></td>
                            <td><?= $t['product_id']; ?></td>
                            <td><?= $t['product_name']; ?></td>
                            <td>
                                <a href="/product/<?= $t['slug']; ?>" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //listProduct();
        $('#tbProduct').DataTable({
            "bPaginate": true,
            "bInfo": true,
            "bFilter": true,
            "bLengthChange": false,
            "pageLength": 5
        });
    });

    function listProduct() {
        $.ajax({
            type: 'ajax',
            url: '/product/viewProduct',
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                var no = 1
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<th>' + $no++ + '</th>' +
                        '<td><img src="/img/product/' + data[i].product_img + '" alt="" class="sampul"></td>' +
                        '<td>' + data[i].product_id + '</td>' +
                        '<td>' + data[i].product_name + '</td>' +
                        '<td>' +
                        '<a href="/product/' + data[i].slug + '" class="btn btn-info">Detail</a>' +
                        '</td>'
                    '</tr>';
                }
                $('#listProduct').html(html);
            }
        });
    }
</script>
<?= $this->endSection(); ?>