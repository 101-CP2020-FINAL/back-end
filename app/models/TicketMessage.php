<?php

namespace app\models;

use app\tables\TblTicketMessage;

class TicketMessage extends TblTicketMessage
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Задача',
            'ticket.title' => 'Задача',
            'employer_id' => 'Сотрудник',
            'employer.fio' => 'Сотрудник',
            'message_type_id' => 'Тип сообщения',
            'messageType.title' => 'Тип сообщения',
            'message' => 'Сообщение',
            'date_created' => 'Дата создания',
        ];
    }

    public function getEmployer()
    {
        return $this->hasOne(Employer::className(), ['id' => 'employer_id']);
    }
}