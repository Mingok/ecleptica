<?php
require_once 'classes/prenda/prenda.php';
$prendaList = new prenda ();
$prendas = $prendaList->prendasDisponibles();
?>

<div id="prendasDevolucion">
    <div class="panel panel-default">
        <div class="panel-heading">  
            <div class="row" style="text-align: right; padding-right: 20px;">
                <table  style="width: 100%">
                    <tr>
                        <td style="text-align: left; padding-left: 20px;">
                            <h3 class="panel-title">
                                Prendas
                            </h3>
                        </td>
                    <tr>
                </table>
            </div>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-12 scrolPrenda" >
                    <table class="tabla">
                        <tr>
                            <td style="text-align: right;">
                                <div class="scrol1">
                                    <table class="table table-condensed" id="tblPrendaVenta">
                                        <thead class="btn-success" style="font-weight: bolder; text-align: center;">
                                            <tr>
                                                <td>
                                                    Mod
                                                </td>
                                                <td>
                                                    Cod
                                                </td>
                                                <td style="width: 30%">
                                                    Nombre
                                                </td>
                                                <td>
                                                    Talle
                                                </td>
                                                <td>
                                                    Color
                                                </td>
                                                <td>
                                                    Estampado
                                                </td>
                                                <td>
                                                    Tela
                                                </td>
                                                <td>
                                                    Temporada
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.tabla').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "views/devolucion/ajax_prendas.php",
            "language": {
                "url": "js/datatableUI/spanish_prendas.json"

            },
            //Esto deshabilita el ordenamiento por columnas
            // hay que poner un {"bSortable": false},
            // por cada columna que tenga la tabla
            "aoColumns": [
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false},
                {"bSortable": false}

            ]
        });
        
        $('.tabla').on('draw.dt', function() {
            console.log('pasa1');
            $('#prendasDevolucion .itemDev').on('click',function () {
                console.log('pasa2');
                var url = 'indexComprasCliente.php';
                var idCliente = $('#idClienteVenta').val();
                var idPrenda = $(this).data('idprenda');
                $('input[name=idPrenda]').val(idPrenda);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        'idCliente': idCliente,
                        'idPrenda': idPrenda
                    }, // serializes the form's elements.
                    success: function (data) {
                        if (data) {
                            $('.movimientosClienteCont').html(data);
                        }

                        //cargo este evento aca porque las cosas se traen con ajax
                        $('.ventaDev').on("click", function (e) {
                            var idVenta = $(this).data('idventa');
                            $('input[name=idVenta]').val(idVenta);
                            $('input[name=fechaVenta]').val(fechaVenta);
                            $('.devolverSend').removeAttr('disabled');
                        });
                    }
                });
            });
        });
    });

</script>