<script type="text/javascript">
    // # = id, . = class
    $(document).ready(function() {
        // alert($('#poformid').val());

        if ($('#poformid').val() == 'pocreate') {
            getDate();
            // $('#postatus').val(value = 'Draft');
        }
        if ($('#poformid').val() == 'poedit') {
            // try {
            $('#poid').val(value = '<?= $po['id'] == '' ? null : $po['id'] ?>');
            $('#ponoold').val(value = '<?= $po['id'] == '' ? null : $po['pono'] ?>');
            $('#potype').val(value = '<?= $po['id'] == '' ? null : $po['potype'] ?>');
            $('#pono').val(value = '<?= $po['id'] == '' ? null : $po['pono'] ?>');
            $('#supplierid').val(value = '<?= $po['id'] == '' ? null : $po['supplierid'] ?>');
            $('#podate').val(value = '<?= $po['id'] == '' ? null : $po['podate'] ?>');
            $('#indate').val(value = '<?= $po['id'] == '' ? null : $po['indate'] ?>');
            $('#currency').val(value = '<?= $po['id'] == '' ? null : $po['currency'] ?>');
            $('#discount').val(value = '<?= $po['id'] == '' ? '0.00' : $po['discount'] ?>');
            $('#ppn').val(value = '<?= $po['id'] == '' ? '0.00' : $po['ppn'] ?>');
            $('#postatus').val(value = '<?= $po['id'] == '' ? null : $po['postatus'] ?>');

            $('#potype').attr('disabled', 'disabled');
            $('#pono').attr('readonly', true);
            $('#supplierid').attr('disabled', 'disabled');
            $('#btnSavePo').attr('hidden', true);
            $('#btnProcessPo').attr('hidden', false);
            $("#btnAddDetail").removeAttr('disabled');

            getPOSUM();
        }

        $("#btnAddDetail").click(function() {
            $("#modaladd").modal('show');
            $("#frmAddPoDetail").trigger("reset");
            getPO();
        });

        poSaveUpdate();
        podetailSave();
        podetailUpdate();
        ViewDataTablePoDetail();
    });

    function getDate() {
        var date = new Date();

        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;
        document.getElementById("podate").value = today;
        document.getElementById("indate").value = today;
    }

    function calGt() {
        var dis = parseFloat($('#discount').val());
        var ppn = parseFloat($('#ppn').val());
        var gt = parseFloat($('#grandtotal').val());

        ppn = (ppn * gt) / 100;
        gt = (gt - dis) + ppn;

        alert(gt.toFixed(4));
    }

    function getPO() {
        var pono = $("#pono").val();
        $.ajax({
            url: "<?= base_url('po/getpo') ?>",
            type: "GET",
            data: {
                pono: pono
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(id, pono) {
                    $('#poid').val(data.id);
                    $('#ponoold').val(data.pono);
                    $('#addpoid').val(data.id);
                    $('#addpono').val(data.pono);
                });
            }
        });
    }

    function getPONO() {
        var potype = $("#potype").val();
        $.ajax({
            url: "<?= base_url('po/getpono') ?>",
            type: "GET",
            data: {
                potype: potype
            },
            dataType: "json",
            success: function(response) {
                if (response.pono) {
                    document.getElementById("pono").value = response.pono;
                    // alert(response.pono);
                } else {
                    document.getElementById("pono").value = "0";
                }
            }
        });
    }

    function getPOSUM() {
        var id = $("#poid").val();
        var dis;
        var ppn;
        var grandtotal;
        $.ajax({
            url: "<?= base_url('po/getposum') ?>",
            type: "GET",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.gt) {
                    gt = parseFloat(response.gt);
                    dis = parseFloat($('#discount').val());
                    ppn = parseFloat($('#ppn').val());

                    ppn = (ppn * gt) / 100;
                    gt = (gt - dis) + ppn;

                    $('#grandtotal').val(value = gt.toFixed(4));
                } else {
                    gt = 0;
                    $('#grandtotal').val(value = gt.toFixed(4));
                }
            }
        });
    }

    function poSaveUpdate() {
        $('#btnSavePo').click(function() {
            $url = '<?= base_url('po/savePo') ?>';
            $btn = '#btnSavePo';
            $html = '<i class="fa-solid fa-check"></i>&nbsp;Create PO';
            $metode = 'save';
        });

        $('#btnProcessPo').click(function() {
            $('#potype').removeAttr('disabled');
            $('#pono').attr('readonly', false);
            $('#supplierid').removeAttr('disabled');

            getPOSUM();

            $url = '<?= base_url('po/updatePo') ?>';
            $btn = '#btnProcessPo';
            $html = '<i class="fa-solid fa-check"></i>&nbsp;Process PO';
            $metode = 'update';
        });

        $('#frmAddPo').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $url,
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(xhr) {
                    $($btn).attr('disable', 'disable');
                    $($btn).html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $($btn).removeAttr('disable');
                    $($btn).html($html);
                },
                success: function(response) {
                    if (response.error) {
                        // alert("Form Submited Successfully");
                        // Validasi---------------------------------------
                        if (response.error.potype) {
                            $('#potype').addClass('is-invalid');
                            $('#errorPoType').html(response.error.potype);
                        } else {
                            $('#potype').removeClass('is-invalid');
                            $('#errorPoType').html('');
                        }

                        if (response.error.pono) {
                            $('#pono').addClass('is-invalid');
                            $('#errorPoNo').html(response.error.pono);
                            if ($metode == 'save') {
                                getPONO();
                                $('#pono').removeClass('is-invalid');
                                $('#errorPoNo').html('');
                                $('#btnSavePo').click();
                            }
                        } else {
                            $('#pono').removeClass('is-invalid');
                            $('#errorPoNo').html('');
                        }

                        if (response.error.supplierid) {
                            $('#supplierid').addClass('is-invalid');
                            $('#errorSupplier').html(response.error.supplierid);
                        } else {
                            $('#supplierid').removeClass('is-invalid');
                            $('#errorSupplier').html('');
                        }
                        // endValidasi------------------------------------
                    } else {
                        if ($metode == 'save') {
                            getPO();
                            $('#potype').removeClass('is-invalid');
                            $('#pono').removeClass('is-invalid');
                            $('#supplierid').removeClass('is-invalid');
                            $('#potype').attr('disabled', 'disabled');
                            $('#pono').attr('readonly', true);
                            $('#supplierid').attr('disabled', 'disabled');
                            $('#btnSavePo').attr('hidden', true);
                            $('#btnProcessPo').attr('hidden', false);
                            $('#btnAddDetail').removeAttr('disabled');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else if ($metode == 'update') {
                            $("#frmAddPo").trigger("reset");
                            $("#frmAddPoDetail").trigger("reset");
                            getDate();
                            var dataTable = $('#tbPODetail').DataTable();
                            dataTable.rows().remove().draw();
                            $('#btnSavePo').attr('hidden', false);
                            $('#btnProcessPo').attr('hidden', true);
                            $('#btnAddDetail').attr('disabled', 'disabled');
                            $('#poformid').val(value = 'pocreate');
                            $('#grandtotal').val(value = '0');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            // setInterval(function() {
                            window.location = '<?= base_url('po/') ?>';
                            // }, 300); //1 seconds
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    }

    // PO Detail
    function ViewDataTablePoDetail() {
        if ($('#poformid').val() == 'pocreate') {
            poid = $("#addpoid").val();
        }
        if ($('#poformid').val() == 'poedit') {
            poid = $("#poid").val();
        }
        if (poid != '') {
            dataTablePO = $('#tbPODetail').DataTable({
                processing: true,
                // serverSide: true,
                order: [],
                ajax: {
                    url: "<?= base_url('po/loadlistpo_detail') ?>",
                    type: "POST",
                    data: {
                        poid: poid
                    },
                    dataType: "json",
                },
                bPaginate: true,
                bInfo: true,
                bFilter: true,
                autoWidth: true,
                bDestroy: true,
                columnDefs: [{
                    targets: [9, 10],
                    render: $.fn.dataTable.render.number(',', '.', 4, '', ''),
                    className: "text-right"
                }, ]
            });
        }
    }

    function getItemName() {
        $("#additemname").val($("#additemcode option:selected").text());
    }

    function calculate() {
        var qty;
        var price;
        var total;
        qty = parseFloat($("#addqtyprice").val());
        price = parseFloat($("#addprice").val());
        total = qty * price;
        $("#addtotal").val(total.toFixed(4));
    }

    function calculateedit() {
        var qty;
        var price;
        var total;
        qty = parseFloat($("#editqtyprice").val());
        price = parseFloat($("#editprice").val());
        total = qty * price;
        $("#edittotal").val(total.toFixed(4));
    }

    function podetailSave() {
        $('#frmAddPoDetail').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('po/savePoDetail') ?>",
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(xhr) {
                    calculate();
                    $('#btnSavePoDetail').attr('disable', 'disable');
                    $('#btnSavePoDetail').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnSavePoDetail').removeAttr('disable');
                    $('#btnSavePoDetail').html('Save');
                },
                success: function(response) {
                    if (response.error) {} else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#modaladd").modal('hide');
                        ViewDataTablePoDetail();
                        getPOSUM();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    }

    function podetailEdit(id) {
        $.ajax({
            url: "<?= base_url('po/getpodetail') ?>",
            type: "GET",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $.each(data, function(id, poid, itemcode, itemname, qty, unit, qty2, unit2, qtyprice, qtypriceunit, price, total) {
                    $('#modaledit').modal('show');
                    $('#editid').val(value = data.id);
                    $('#editpoid').val(value = data.poid);
                    $('#edititemcode').val(value = data.itemcode);
                    $('#edititemname').val(value = data.itemname);
                    $('#editqty1').val(value = data.qty);
                    $('#editunit1').val(value = data.unit);
                    $('#editqty2').val(value = data.qty2);
                    $('#editunit2').val(value = data.unit2);
                    $('#editqtyprice').val(value = data.qtyprice);
                    $('#editpriceunit').val(value = data.qtypriceunit);
                    $('#editprice').val(value = data.price);
                    $('#edittotal').val(value = data.total);
                });
            }
        });
    }

    function podetailUpdate() {
        $('#frmEditPoDetail').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('po/updatePoDetail') ?>",
                data: new FormData(this), //$(this).serialize(),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(xhr) {
                    calculate();
                    $('#btnUpdatePoDetail').attr('disable', 'disable');
                    $('#btnUpdatePoDetail').html('<i class="fa fa-spin fa-spinner"</i>');
                },
                complete: function() {
                    $('#btnUpdatePoDetail').removeAttr('disable');
                    $('#btnUpdatePoDetail').html('Update');
                },
                success: function(response) {
                    if (response.error) {} else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#modaledit").modal('hide');
                        ViewDataTablePoDetail();
                        getPOSUM();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    }

    function podetailRemove(id) {
        Swal.fire({
            title: 'Delete',
            text: "Are you sure delete item po ?",
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
                    url: "<?= base_url('/po/deletePoDetail') ?>",
                    data: {
                        id: id
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
                            ViewDataTablePoDetail();
                            getPOSUM();
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