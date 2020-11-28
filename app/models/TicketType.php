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

    public function afterFind()
    {
        $this->template = json_encode($this->template, JSON_UNESCAPED_UNICODE);
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if ($this->template) {
            $this->template = json_decode($this->template, true, 512,JSON_UNESCAPED_UNICODE);
        }
        return parent::beforeSave($insert);
    }
}