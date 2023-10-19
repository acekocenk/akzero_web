<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="formview" style="display: none;"></div>
            <div class="formaksi" style="display: none;"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // # = id, . = class

    $(document).ready(function() {
        viewdata();
    });

    function viewdata() {
        $.ajax({
            url: "/po/loaddata",
            dataType: "json",
            success: function(response) {
                $('.formview').html(response.view).show();
                // let timerInterval
                // Swal.fire({
                //     title: 'Load po',
                //     timer: 1000,
                //     timerProgressBar: true,
                //     willOpen: () => {
                //         Swal.showLoading()
                //         timerInterval = setInterval(() => {
                //             const content = Swal.getContent()
                //             if (content) {
                //                 const b = content.querySelector('b')
                //                 if (b) {
                //                     b.textContent = Swal.getTimerLeft()
                //                 }
                //             }
                //         }, 100)
                //     },
                //     onClose: () => {
                //         clearInterval(timerInterval)
                //     }
                // }).then((result) => {
                //     /* Read more about handling dismissals below */
                //     if (result.dismiss === Swal.DismissReason.timer) {
                //         console.log('I was closed by the timer')
                //     }
                // })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>