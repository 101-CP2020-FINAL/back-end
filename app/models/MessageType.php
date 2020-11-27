<?php

namespace app\models;

use app\tables\TblMessageType;
use yii\helpers\ArrayHelper;

class MessageType extends TblMessageType
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}