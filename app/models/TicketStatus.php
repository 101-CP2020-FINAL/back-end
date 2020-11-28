<?php

namespace app\models;


use app\tables\TblTicketStatus;
use yii\helpers\ArrayHelper;

class TicketStatus extends TblTicketStatus
{

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название'
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}