<?php

namespace app\models;

use app\tables\TblDepartment;
use yii\helpers\ArrayHelper;

class Department extends TblDepartment
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'parent_id' => 'Родитель'
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}