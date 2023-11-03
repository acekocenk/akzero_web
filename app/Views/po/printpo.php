<?= $this->extend('layout/templateprint'); ?>

<?= $this->section('content'); ?>
<?php foreach ($po as $p) : ?>
    <style>
        /* .table-bordered tbody tr {
        border: 2px solid gray;
    }

    .table-bordered tbody tr td {
        border: 2px solid gray;
    }

    .table-bordered tbody tr {
        border: 2px solid gray;
    }

    .table-bordered thead tr {
        border: 2px solid gray;
    }

    .table-bordered thead tr th {
        border: 2px solid gray;
    } */
    </style>
    <div class="row mb-5">
    </div>
    <!-- <center> -->
    <div class="card border-secondary mb-3" style="max-width: 80rem; border:0px">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-2" align="Left">
                    <img src="/img/logoBIG.jpg" class="img-thumbnail img-preview" style="width:130px;height:150px;">
                </div>
                <div class="col-sm-6" align="Left">
                    <div class="row mb-3">
                    </div>
                    <div class="row">
                        <h2><b>PT. BUMI INDAH GLOBAL</b></h2>
                    </div>
                    <div class="row">
                        <p style="font-size:15px"><b>MANUFACTURER OF CUSTOM MADE WINDOW FURNISHING</b><br>
                            JL. RAYA CIKANDE-RANGKASBITUNG KM. 4.5 DESA KAREO,<br>
                            SERANG, BANTEN - INDONESIA
                        </p>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                    </div>
                </div>
                <div class="col-sm-4" align="Right">
                    <div class="row mb-5">
                    </div>
                    <div class="row mb-5">
                    </div>
                    <div class="row mb-3">
                    </div>
                    <div class="row">
                        <h4><b>PURCHASE ORDER</b></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body text-secondary">
            <div class="row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">PO NO</label>
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">: <?= $p->pono; ?></label>
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">TO</label>
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">: <?= $p->suppliername; ?></label>
            </div>
            <div class="row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">PO DATE</label>
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">: <?= date_format(date_create(($p->podate)), 'd F Y'); ?></label>
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ADDRESS</label>
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">: <?= $p->address ?></label>
            </div>
            <div class="row mb-3">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">DELIVERY DATE</label>
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">: <?= date_format(date_create(($p->indate)), 'd F Y'); ?></label>
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">PHONE NUMBER</label>
                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">: <?= $p->telp ?></label>
            </div>
            <!-- Detail -->
            <div class="row mb-3">
                <table class="table table-bordered table-sm" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>ITEM ID</th>
                            <th>ITEM NAME</th>
                            <th>QTY</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody id="tbPODetailData">
                        <tr>
                            <th>A1</th>
                            <td>B1</td>
                            <td>C1</td>
                            <td>D1</td>
                            <td>E1</td>
                            <td>F1</td>
                            <td>G1</td>
                        </tr>
                        <tr>
                            <th>A2</th>
                            <td>B2</td>
                            <td>C2</td>
                            <td>D2</td>
                            <td>E2</td>
                            <td>F2</td>
                            <td>G2</td>
                        </tr>
                        <tr>
                            <th>A3</th>
                            <td>B3</td>
                            <td>C3</td>
                            <td>D3</td>
                            <td>E3</td>
                            <td>F3</td>
                            <td>G3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="row">PAYMENT INFORMATION :</div>
                    <div class="row">ISI PAYMENT</div>
                    <div class="row">NOTE :</div>
                    <div class="row">ISI NOTE</div>
                    <div class="row">WRITTEN :</div>
                    <div class="row">ISI WRITTEN</div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-sm-4" align="Left">SUBTOTAL</div>
                        <div class="col-sm-2" align="Left">: IDR</div>
                        <div class="col-sm-6" align="Right">1,000,000,.0000</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" align="Left">DISCLOUNT</div>
                        <div class="col-sm-2" align="Left">: IDR</div>
                        <div class="col-sm-6" align="Right">1,000,000,.0000</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" align="Left">VAT %</div>
                        <div class="col-sm-2" align="Left">: IDR</div>
                        <div class="col-sm-6" align="Right">10.0000</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" align="Left">GRAND TOTAL</div>
                        <div class="col-sm-2" align="Left">: IDR</div>
                        <div class="col-sm-6" align="Right">1,000,000,.0000</div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <b>APPROVED</b>
            </div>
            <div class="row mb-3"></div>
            <div class="row">
                <div class="col-sm-4" align="center"><b><U>JACOB</U></b> <br> <b>DIRECTOR</b> </div>
                <div class="col-sm-4" align="center"><b><U>AMAD</U></b> <br> <b>PLAT MANAGER</b> </div>
                <div class="col-sm-4" align="center"><b><U>ARIS</U></b> <br> <b>PURCHASER</b> </div>
            </div>
        </div>
    </div>
    <!-- </center> -->
<?php endforeach; ?>
<?= $this->endSection(); ?>