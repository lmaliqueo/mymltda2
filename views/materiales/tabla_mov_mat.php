

<?php $contador_ut=0; ?>
<table class="table table-bordered">
    <tr class="bg-light-blue">
        <th>Orden de Trabajo</th>
        <th>Material</th>
        <th>Cantidad</th>
        <?php /*<th>Enviado</th>*/ ?>
        <th>Fecha</th>
        <th></th>
    </tr>
    <?php foreach ($adquiridos as $adq) { 
        if ($utilizados != NULL) {
            foreach ($utlizados as $utilizado) {
                if ($adq->AD_FECHA < $utilizado[$contador_ut]->CU_FECHA_FINAL) { ?>
                    <tr>
                        <td><?= $adq->sM->oT->OT_NOMBRE ?></td>
                        <td><?= $adq->mA->MA_NOMBRE ?></td>
                        <td><?= $adq->AD_CANTIDAD ?></td>
                        <td><?= $adq->AD_FECHA ?></td>
                        <?php break; ?>
                    </tr>
            <?php }else{ ?>
                    <tr>
                        <td><?= $utilizado[$contador_ut]->sM->oT->OT_NOMBRE ?></td>
                        <td><?= $utilizado[$contador_ut] ?></td>
                        <td><?= $utilizado[$contador_ut] ?></td>
                    </tr>
                <?php $contador_ut=$contador_ut+1;
                }
            } 
        }else{  ?>
            <tr>
                <td><?= $adq->sM->oT->OT_NOMBRE ?></td>
                <td><?= $adq->mA->MA_NOMBRE ?></td>
                <td><?= $adq->AD_CANTIDAD ?></td>
                <td><?= $adq->AD_FECHA ?></td>
                <td><i class="glyphicon glyphicon-arrow-up text-green"></i></td>
            </tr>
    <?php }} ?>
</table>