<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- <h3 class="my-3"><//?= $title; ?></h3> -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h3 align="center"><?= $title; ?></h3>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="frmPoCreate">
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <div class="col">
                                <label from="" class="control-label">PO ID</label>
                                <input class="form-control form-control-sm" id="exampleFormControlInput1" type="input" placeholder="">
                            </div>
                            <div class="col">
                                <label from="" class="control-label">PO NO</label>
                                <input class="form-control form-control-sm" id="exampleFormControlInput1" type="input" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label from="" class="control-label">PO Date</label>
                                <input class="form-control form-control-sm" id="exampleFormControlInput1" type="date" placeholder="">
                            </div>
                            <div class="col">
                                <label from="" class="control-label">PO Date In</label>
                                <input class="form-control form-control-sm" id="exampleFormControlInput1" type="date" placeholder="">
                            </div>
                            <div class="col">
                                <label from="currency" class="control-label">Currency</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="currency" name="currency">
                                    <option selected>XXX</option>
                                    <option value="IDR">IDR</option>
                                    <option value="AUD">AUD</option>
                                    <option value="RMB">RMB</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="col">
                                <label from="supplier" class="control-label">Supplier</label>
                                <select class="custom-select custom-select-sm" aria-label="Default select example" id="supplier" name="supplier">
                                    <option selected>Open this select</option>
                                    <?php foreach ($supplier as $t) : ?>
                                        <option value="<?= $t['id']; ?>"><?= $t['suppliername']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- <div class="col">
                                <label from="" class="control-label">PPN</label>
                                <input class="form-control form-control-sm" id="exampleFormControlInput1" type="number" value="0" min="0">
                            </div>
                            <div class="col">
                                <label from="" class="control-label">Discount</label>
                                <input class="form-control form-control-sm" id="exampleFormControlInput1" type="number" value="0" min="0">
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    </script>
    <?= $this->endSection(); ?>