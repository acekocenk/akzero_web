<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col">
        <?= csrf_field(); ?>
        <input type="hidden" id="userid" name="userid" value="<?= user()->id; ?>">
        <div class="formview" style="display: none;"></div>
        <div class="formaksi" style="display: none;"></div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        viewdata();
    });

    function viewdata() {
        var Userid = $('#userid').val();
        $.ajax({
            url: "/userprofile/loaddata",
            dataType: "json",
            data: {
                userid: Userid
            },
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