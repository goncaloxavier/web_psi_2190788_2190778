<?php

use yii\db\Migration;

/**
 * Class m201222_193933_init_rbac
 */
class m201222_193933_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createAvaria = $auth->createPermission('createAvaria');
        $createAvaria->description = 'Create avaria';
        $auth->add($createAvaria);

        // add "updatePost" permission
        $updateAvaria = $auth->createPermission('updateAvaria');
        $updateAvaria->description = 'Update avaria';
        $auth->add($updateAvaria);

        $createDispositivo = $auth->createPermission('createDispositivo');
        $createDispositivo->description = 'Create dispositivo';
        $auth->add($createDispositivo);

        $updateDispositivo = $auth->createPermission('updateDispositivo');
        $updateDispositivo->description = 'Update dispositivo';
        $auth->add($updateDispositivo);

        // add "author" role and give this role the "createPost" permission
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $auth->addChild($funcionario, $createAvaria);
        $auth->addChild($funcionario, $updateAvaria);

        $tecnico = $auth->createRole('tecnico');
        $auth->add($tecnico);
        $auth->addChild($funcionario, $createAvaria);
        $auth->addChild($funcionario, $updateAvaria);
        $auth->addChild($funcionario, $createDispositivo);
        $auth->addChild($funcionario, $updateDispositivo);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}
