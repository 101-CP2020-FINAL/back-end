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
            'name' => 'internal',
            'access_token' => Yii::$app->security->generateRandomString(100),
        ]);

        $this->createTable('tbl_user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'access_token' => $this->string(),
            'date_created' => $this->integer()
        ]);

        $this->createTable('tbl_department', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'parent_id' => $this->integer()
        ]);

        $this->batchInsert('tbl_department', ['id', 'title', 'parent_id'], [
            [
                'id' => 1,
                'title' => 'Цех 1',
                'parent_id' => null
            ],
            [
                'id' => 2,
                'title' => 'Участок 1',
                'parent_id' => 1
            ],
            [
                'id' => 3,
                'title' => 'Участок 2',
                'parent_id' => 1
            ],
            [
                'id' => 4,
                'title' => 'Корпус 1',
                'parent_id' => 2
            ],
            [
                'id' => 5,
                'title' => 'Корпус 2',
                'parent_id' => 2
            ],
            [
                'id' => 6,
                'title' => 'Корпус 1',
                'parent_id' => 3
            ],
            [
                'id' => 7,
                'title' => 'Зона обслуживания 1',
                'parent_id' => 6
            ],
            [
                'id' => 8,
                'title' => 'Зона обслуживания 2',
                'parent_id' => 6
            ],
        ]);

        $this->addForeignKey('fk_department_parent', 'tbl_department', 'parent_id', 'tbl_department', 'id', 'CASCADE');

        $this->createTable('tbl_role', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ]);

        $this->batchInsert('tbl_role', ['title'], [
            ['title' => 'исполнитель'],
            ['title' => 'мастер'],
            ['title' => 'начальник участка'],
            ['title' => 'начальник цеха']
        ]);

        $this->createTable('tbl_group', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ]);

        $this->batchInsert('tbl_group', ['title'], [
            ['title' => 'Мастера'],
            ['title' => 'Начальники участков'],
            ['title' => 'Инженеры по ТБ']
        ]);

        $this->createTable('tbl_employer', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'external_id' => $this->integer(),
            'date_created' => $this->integer()
        ]);

        $this->addForeignKey('fk_user_employer', 'tbl_employer', 'user_id', 'tbl_user', 'id', 'CASCADE');

        $this->createTable('tbl_employer_group', [
            'employer_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_group_to_employer', 'tbl_employer_group', 'group_id', 'tbl_group', 'id', 'CASCADE');
        $this->addForeignKey('fk_employer_to_group', 'tbl_employer_group', 'employer_id', 'tbl_employer', 'id', 'CASCADE');

        $this->createTable('tbl_staff', [
            'id' => $this->primaryKey(),
            'employer_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull(),
            'role_id' => $this->integer()->notNull(),
            'lead' => $this->boolean(),
        ]);

        $this->addForeignKey('fk_staff_to_employer', 'tbl_staff', 'employer_id', 'tbl_employer', 'id', 'CASCADE');
        $this->addForeignKey('fk_staff_to_department', 'tbl_staff', 'department_id', 'tbl_department', 'id', 'CASCADE');
        $this->addForeignKey('fk_staff_to_role', 'tbl_staff', 'role_id', 'tbl_role', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_internal_services');

        $this->dropForeignKey('fk_staff_to_employer', 'tbl_staff');
        $this->dropForeignKey('fk_staff_to_department', 'tbl_staff');
        $this->dropForeignKey('fk_staff_to_role', 'tbl_staff');

        $this->dropTable('tbl_staff');

        $this->dropForeignKey('fk_group_to_employer', 'tbl_employer_group');
        $this->dropForeignKey('fk_employer_to_group', 'tbl_employer_group');
        $this->dropForeignKey('fk_user_employer', 'tbl_employer');

        $this->dropTable('tbl_employer_group');
        $this->dropTable('tbl_employer');
        $this->dropTable('tbl_group');
        $this->dropTable('tbl_user');
        $this->dropTable('tbl_role');

        $this->dropForeignKey('fk_department_parent', 'tbl_department');
        $this->dropTable('tbl_department');


        return true;
    }
}
