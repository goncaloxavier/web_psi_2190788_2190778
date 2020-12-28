<?php

use yii\db\Migration;

/**
 * Class m201228_210747_init_rbac
 */
class m201228_210747_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $rule = new backend\models\AuthorRule;
        $auth->add($rule);

        $updateAvaria = $auth->getPermission("updateAvaria");

        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnAvaria = $auth->createPermission('updateOwnAvaria');
        $updateOwnAvaria->description = 'Update own avaria';
        $updateOwnAvaria->ruleName = $rule->name;
        $auth->add($updateOwnAvaria);

        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnAvaria, $updateAvaria);

        $funcionario = $auth->getRole("funcionario");

        // allow "author" to update their own posts
        $auth->addChild($funcionario, $updateOwnAvaria);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201228_210747_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201228_210747_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
