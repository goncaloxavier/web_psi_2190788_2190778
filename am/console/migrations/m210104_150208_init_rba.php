<?php

use yii\db\Migration;

/**
 * Class m210104_150208_init_rba
 */
class m210104_150208_init_rba extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createAvaria = $auth->getPermission('createAvaria');
        $updateAvaria = $auth->getPermission('updateAvaria');
        $updateOwnAvaria = $auth->getPermission('updateOwnAvaria');
        $createDispositivo = $auth->getPermission('createDispositivo');
        $updateDispositivo = $auth->getPermission('updateDispositivo');

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createAvaria);
        $auth->addChild($admin, $updateAvaria);
        $auth->addChild($admin, $updateOwnAvaria);
        $auth->addChild($admin, $createDispositivo);
        $auth->addChild($admin, $updateDispositivo);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210104_150208_init_rba cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210104_150208_init_rba cannot be reverted.\n";

        return false;
    }
    */
}
