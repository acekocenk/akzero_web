<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <input type="input" id="poid" name="poid" value="<?= $po['id']; ?>">
    <input type="input" id="pono" name="pono" value="<?= $po['pono']; ?>">
</div>
<script type="text/javascript">
</script>
<?= $this->endSection(); ?>n