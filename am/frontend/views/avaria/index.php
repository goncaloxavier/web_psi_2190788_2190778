<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div class="avaria-index">
    <table border="1" width="100%" style="overflow: auto">
        <?php
            foreach ($avarias as $avaria) {
             $dispositivo = $avaria->idDispositivo0;
        ?>
                <th>Data</th><th>Descricao</th><th>Dispositivo</th><th>Estado</th>
                <tr>
                    <td><?= $avaria->data ?></td><td><?= $avaria->descricao ?></td><td><?= $dispositivo->referencia ?></td><?= $avaria->getEstado() ?>
        <?php
            }
        ?>
    </table>
</div>
