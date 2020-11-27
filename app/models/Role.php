<?php

namespace app\models;

use app\tables\TblRole;
use yii\helpers\ArrayHelper;

class Role extends TblRole
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