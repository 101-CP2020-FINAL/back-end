<?php

use yii\db\Migration;

/**
 * Class m201127_171900_init
 */
class m201127_171900_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_internal_services', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'access_token' => $this->string()->notNull(),
        ]);

        $this->insert('tbl_internal_services', [
            'name' => 'mobile',
            'token' => Yii::$app->security->generateRandomString(100),
        ]);

        $this->insert('tbl_internal_services', [
            'name' => 'manager',
            'token' => Yii::$app->security->generateRandomString(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_internal_services');

        return true;
    }
}
