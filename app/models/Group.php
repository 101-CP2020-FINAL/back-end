<?php

namespace app\models;

use app\tables\TblGroup;
use yii\helpers\ArrayHelper;

class Group extends TblGroup
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