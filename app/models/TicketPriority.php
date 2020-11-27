<?php

namespace app\models;

use app\tables\TblTicketPriority;
use yii\helpers\ArrayHelper;

class TicketPriority extends TblTicketPriority
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'weight' => 'Вес'
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}