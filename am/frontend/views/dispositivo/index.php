<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="dispositivo-index">
    <table border="1" width="100%" style="overflow: auto">
        <?php
            foreach ($dispositivos as $dispositivo) {
        ?>
                <th>Data Compra</th><th>Referencia</th><th>Estado</th>
                <?php
                    echo "<tr onclick=location.href='dispositivo/".$dispositivo->idDispositivo."'>";
                ?>
                    <td><?= $dispositivo->dataCompra ?></td><td><?= $dispositivo->referencia ?></td><?= $dispositivo->getEstado() ?>
        <?php
            }
        ?>
    </table>
</div>
