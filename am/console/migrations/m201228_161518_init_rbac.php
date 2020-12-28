<?php

use yii\db\Migration;

/**
 * Class m201228_161518_init_rbac
 */
class m201228_161518_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createAvaria = $auth->getPermission('createAvaria');
        // add "updatePost" permission
        $updateAvaria = $auth->getPermission('updateAvaria');

        $createDispositivo = $auth->createPermission('createDispositivo');
        $createDispositivo->description = 'Create dispositivo';
        $auth->add($createDispositivo);

        $updateDispositivo = $auth->createPermission('updateDispositivo');
        $updateDispositivo->description = 'Update dispositivo';
        $auth->add($updateDispositivo);

        $tecnico = $auth->createRole('tecnico');
        $auth->add($tecnico);
        $auth->addChild($tecnico, $createAvaria);
        $auth->addChild($tecnico, $updateAvaria);
        $auth->addChild($tecnico, $createDispositivo);
        $auth->addChild($tecnico, $updateDispositivo);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201228_161518_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201228_161518_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
