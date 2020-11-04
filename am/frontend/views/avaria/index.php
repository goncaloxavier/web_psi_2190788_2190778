<?php

use Yii;
use yii\helpers\Html;
use yii\base\ViewRenderer;
use yii\helpers\Url;
?>
<div class="avaria-index">
    <table border="1" width="100%" style="overflow: auto">
        <?php
            foreach ($avarias as $avaria) {
             $dispositivo = $avaria->idDispositivo0;
        ?>
                <th>Data</th><th>Descricao</th><th>Dispositivo</th><th>Estado</th>
                <?php
                    echo "<tr onclick=location.href='avaria/".$avaria->idAvaria."'>";
                ?>
                    <td><?= $avaria->data ?></td><td><?= $avaria->descricao ?></td><td><?= $dispositivo->referencia ?></td><?= $avaria->getEstado() ?>
        <?php
            }
        ?>
    </table>
    <ul>
        <li>Resolvido <button style="background-color: yellow; border: none; height: 20px; width: 20px;"></button></li>
</div>