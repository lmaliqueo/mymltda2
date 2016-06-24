<!DOCTYPE html>

 <html>
 <head>
     <title>Informe OT</title>
 </head>
<style>
 body {font-family: sans-serif;
 font-size: 10pt;
 }
 p { margin: 0pt;
 }
 td { vertical-align: top; }
 .items td {
 border-left: 0.1mm solid #000000;
 border-right: 0.1mm solid #000000;
 }
 table thead td { background-color: #EEEEEE;
 text-align: center;
 border: 0.1mm solid #000000;
 }
 .items td.blanktotal {
 background-color: #FFFFFF;
 border: 0mm none #000000;
 border-top: 0.1mm solid #000000;
 }
 .items td.totals {
 text-align: right;
 border: 0.1mm solid #000000;
 }
</style>
 <body>
<div class="row">
    <div style="text-align: center">
        <h1 style="margin-bottom: 0;">INFORME OT</h1>
        <h1 style="margin-top: 0;"><?= $model->pRO->PRO_NOMBRE  ?></h1>
    </div>

    <h3 style="text-align: center"><?= $model->pRO->PRO_NOMBRE  ?></h3>
    <p style="text-align: center">desde <strong><?= $model->OT_FECHA_INICIO ?></strong> a <strong><?= $model->OT_FECHA_TERMINO ?></strong></p>
            <table style="border: 1;" width="100%">
                <tr>
                    <th>Cliente</th>
                    <td><?= $model->pRO->eMPRUT->EMP_NOMBRE ?></td>
                    <th>RUT</th>
                    <td><?= $model->pRO->EMP_RUT ?></td>
                </tr>
                <tr>
                    <th>Domicilio</th>
                    <td><?= $model->pRO->eMPRUT->EMP_DIRECCION ?></td>
                    <th>Comuna</th>
                    <td><?= $model->pRO->eMPRUT->cOM->COM_NOMBRE ?></td>
                </tr>
                <tr>
                    <th>Proyecto</th>
                    <td></td>
                    <th>Fecha</th>
                    <td><?= $model->OT_FECHA_INICIO ?> a <?= $model->OT_FECHA_TERMINO ?></td>
                </tr>
            </table>
    <div class="col-md-6">
        <br>
            <h2>Actividades</h2>

        <table style="border: 1;" width="100%">
            <?php foreach ($actividades as $cont_act => $act) { ?>
                <tr style="border: 0;">
                    <td style="border: 1;"><?= ($cont_act+1)." ".$act->AC_NOMBRE ?></td>
                    <td style="border: 1;"><?= $act->AC_FECHA_INICIO ?></td>
                    <td style="border: 1;"><?= $act->AC_FECHA_TERMINO ?></td>
                    <td style="border: 1;">$ <?= $act->AC_COSTO_TOTAL ?></td>
                </tr>
                <?php foreach ($items as $cont_it => $item) {
                    if ($item->AC_ID==$act->AC_ID) { ?>
                        <tr>
                            <td style="text-align: center"><?= ($cont_act+1).".".($cont_it+1)." ".$item->sACT->SACT_NOMBRE ?></td>
                            <td><?= $item->AS_CANTIDAD ?></td>
                            <td><?=$item->AS_COSTOTOTAL ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
    <div class="col-md-6">
    </div>
</div>
 
 </body>

 </html>
