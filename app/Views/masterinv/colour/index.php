<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- <div class="container"> -->
<div class="row">
    <div class="col">
        <div class="formview" style="display: none;"></div>
        <div class="formaksi" style="display: none;"></div>
    </div>
</div>
<!-- </div> -->
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        viewdata(); //ViewForm Table, Form Add, Form Edit
    });

    function viewdata() {
        $.ajax({
            url: "/colour/loaddata",
            dataType: "json",
            success: function(response) {
                $('.formview').html(response.view).show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>