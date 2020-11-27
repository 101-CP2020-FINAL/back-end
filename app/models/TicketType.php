<?php

namespace app\models;

use app\tables\TblTicketType;
use yii\helpers\ArrayHelper;

class TicketType extends TblTicketType
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'template' => 'Шаблон'
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}