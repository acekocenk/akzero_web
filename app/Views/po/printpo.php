<?= $this->extend('layout/templateprint'); ?>

<?= $this->section('content'); ?>
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
                <img src="/img/items/default.png" class="img-thumbnail img-preview">
            </div>
            <div class="col-sm-6" align="Left">
                <div class="row mb-3">
                </div>
                <div class="row">
                    <h2><b>PT. BUMI INDAH GLOBAL</b></h2>
                </div>
                <div class="row mb-5"></div>
                <div class="row">
                    <h4>PURCHASE ORDER</h4>
                </div>
            </div>
            <div class="col-sm-4" align="Right">
                <div class="row mb-5">
                </div>
                <div class="row mb-5">
                </div>
                <div class="row mb-3">
                </div>
                <div class="row mb-3">
                </div>
                <div class="row">
                    <h6>PONO : BIGLK2310-0002</h6>
                </div>
            </div>
        </div>
    </div>
    <div class=" card-body text-secondary">
        <div class="row">
            <div class="col-sm-2" align="Right">A :</div>
            <div class="col-sm-4" align="Left">A1</div>
            <div class="col-sm-2" align="Right">B :</div>
            <div class="col-sm-4" align="Left">B1</div>
        </div>
        <div class="row">
            <div class="col-sm-2" align="Right">C :</div>
            <div class="col-sm-4" align="Left">C1</div>
            <div class="col-sm-2" align="Right">D :</div>
            <div class="col-sm-4" align="Left">D1</div>
        </div>
        <div class="row">
            <div class="col-sm-2" align="Right">E :</div>
            <div class="col-sm-4" align="Left">E1</div>
            <div class="col-sm-2" align="Right">F :</div>
            <div class="col-sm-4" align="Left">F1</div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-2" align="Right">G :</div>
            <div class="col-sm-4" align="Left">G1</div>
            <div class="col-sm-2" align="Right">H :</div>
            <div class="col-sm-4" align="Left">H1</div>
        </div>
        <!-- Detail -->
        <table class="table table-bordered table-sm" cellspacing="0">
            <thead>
                <tr>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                </tr>
            </thead>
            <tbody id="tbPODetailData">
                <tr>
                    <th>A1</th>
                    <td>B1</td>
                    <td>C1</td>
                    <td>D1</td>
                    <td>E1</td>
                </tr>
                <tr>
                    <th>A2</th>
                    <td>B2</td>
                    <td>C2</td>
                    <td>D2</td>
                    <td>E2</td>
                </tr>
                <tr>
                    <th>A3</th>
                    <td>B3</td>
                    <td>C3</td>
                    <td>D3</td>
                    <td>E3</td>
                </tr>
            </tbody>
        </table>
        <div class="row mb-5"></div>
        <center>
            <div class="row mb-5">
                <div class="col">A</div>
                <div class="col">B</div>
                <div class="col">C</div>
            </div>
            <div class="row mb-5"></div>
            <div class="row">
                <div class="col">A1</div>
                <div class="col">B1</div>
                <div class="col">C1</div>
            </div>
        </center>
    </div>
</div>
<!-- </center> -->
<?= $this->endSection(); ?>