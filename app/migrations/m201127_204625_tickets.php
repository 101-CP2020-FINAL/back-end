<?php

use yii\db\Migration;

/**
 * Class m201127_204625_tickets
 */
class m201127_204625_tickets extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_ticket_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'template' => 'jsonb'
        ]);
        
        $this->batchInsert('tbl_ticket_type', ['title', 'template'], [
            ['title' => 'Провести инструктаж на участке', 'template' => json_encode([
                'title' => 'Проведение инструктажа по {{briefing_target}} на участке {{briefing_department}}',
                'priority_id' => 2,
                'description' => 'Необходимо провести инструктаж по {{briefing_target}} на участке {{briefing_department}} для сотрудников {{employees}}',
                'date_start' => '{{date_start}}',
                'deadline' => '{{deadline}}',
            ], JSON_UNESCAPED_UNICODE)],
            ['title' => 'Соблюдать требования безопасности', 'template' => null],
            ['title' => 'Ожидание комиссии', 'template' => null],
            ['title' => 'Провести замеры геометрии', 'template' => null],
            ['title' => 'Провести визуальный осмотр, контроль', 'template' => null],
            ['title' => 'Следить за работой', 'template' => null],
            ['title' => 'Провести замену', 'template' => null],
            ['title' => 'Дополнительный контроль', 'template' => null],
            ['title' => 'Изменение режима работы установки', 'template' => null],
        ]);

        $this->createTable('tbl_ticket_priority', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'weight' => $this->integer()->notNull()
        ]);

        $this->batchInsert('tbl_ticket_priority', ['title', 'weight'], [
            [
                'title' => 'низкая',
                'weight' => 10
            ],
            [
                'title' => 'нормальная',
                'weight' => 20
            ],
            [
                'title' => 'срочная',
                'weight' => 30
            ],
            [
                'title' => 'авария',
                'weight' => 40
            ],
        ]);

        $this->createTable('tbl_message_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()
        ]);
        
        $this->batchInsert('tbl_message_type', ['title'], [
            ['title' => 'сообщение'],
            ['title' => 'задача назначена'],
            ['title' => 'с задачей ознакомлен'],
            ['title' => 'задача принята к выполнению'],
            ['title' => 'задача выполнена'],
            ['title' => 'выполнение проверено'],
            ['title' => 'задача делегирована'],
        ]);

        $this->createTable('tbl_ticket', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'priority_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'date_created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'author_id' => $this->integer(),
            'deadline' => $this->timestamp(),
            'date_start' => $this->timestamp(),
            'parent_id' => $this->integer()
        ]);

        $this->addForeignKey('fk_ticket_type', 'tbl_ticket', 'type_id', 'tbl_ticket_type', 'id');
        $this->addForeignKey('fk_ticket_priority', 'tbl_ticket', 'priority_id', 'tbl_ticket_priority', 'id');
        $this->addForeignKey('fk_ticket_parent', 'tbl_ticket', 'parent_id', 'tbl_ticket', 'id', 'SET NULL');

        $this->createTable('tbl_ticket_employees', [
            'employer_id' => $this->integer()->notNull(),
            'ticket_id' => $this->integer()->notNull(),
            'date_created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->addPrimaryKey('pk_tbl_ticket_employees', 'tbl_ticket_employees', ['employer_id', 'ticket_id']);
        $this->addForeignKey('fk_ticket_employer', 'tbl_ticket_employees', 'ticket_id', 'tbl_ticket', 'id', 'CASCADE');
        $this->addForeignKey('fk_employer_ticket', 'tbl_ticket_employees', 'employer_id', 'tbl_employer', 'id', 'CASCADE');

        $this->createTable('tbl_ticket_file', [
            'id' => $this->primaryKey(),
            'ticket_id' => $this->integer()->notNull(),
            'path' => $this->string()->notNull(),
            'date_created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey('fk_file_ticket', 'tbl_ticket_file', 'ticket_id', 'tbl_ticket', 'id', 'CASCADE');

        $this->createTable('tbl_ticket_message', [
            'id' => $this->primaryKey(),
            'ticket_id' => $this->integer()->notNull(),
            'employer_id' => $this->integer(),
            'message_type_id' => $this->integer(),
            'message' => $this->text()->notNull(),
            'date_created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey('fk_message_ticket', 'tbl_ticket_message', 'ticket_id', 'tbl_ticket', 'id', 'CASCADE');
        $this->addForeignKey('fk_message_type', 'tbl_ticket_message', 'message_type_id', 'tbl_message_type', 'id');
        $this->addForeignKey('fk_message_employer', 'tbl_ticket_message', 'employer_id', 'tbl_employer', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_message_ticket', 'tbl_ticket_message');
        $this->dropForeignKey('fk_message_type', 'tbl_ticket_message');
        $this->dropForeignKey('fk_message_employer', 'tbl_ticket_message');

        $this->dropTable('tbl_ticket_message');

        $this->dropForeignKey('fk_file_ticket', 'tbl_ticket_file');
        $this->dropTable('tbl_ticket_file');

        $this->dropForeignKey('fk_ticket_employer', 'tbl_ticket_employees');
        $this->dropForeignKey('fk_employer_ticket', 'tbl_ticket_employees');

        $this->dropPrimaryKey('pk_tbl_ticket_employees', 'tbl_ticket_employees');

        $this->dropTable('tbl_ticket_employees');

        $this->dropForeignKey('fk_ticket_type', 'tbl_ticket');
        $this->dropForeignKey('fk_ticket_priority', 'tbl_ticket');
        $this->dropForeignKey('fk_ticket_parent', 'tbl_ticket');

        $this->dropTable('tbl_ticket');

        $this->dropTable('tbl_ticket_type');
        $this->dropTable('tbl_ticket_priority');
        $this->dropTable('tbl_message_type');

        return true;
    }
}
