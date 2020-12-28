<?php

use yii\db\Migration;

/**
 * Class m201228_215649_init_rbac
 */
class m201228_215649_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $tecnico = $auth->getRole("tecnico");
        $updateOwnAvaria =  $auth->getPermission("updateOwnAvaria");
        $auth->addChild($tecnico, $updateOwnAvaria);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201228_215649_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201228_215649_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
