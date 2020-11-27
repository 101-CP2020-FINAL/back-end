<?php
namespace app\models;

use app\tables\TblInternalServices;

class InternalService extends TblInternalServices
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'access_token' => 'Токен',
        ];
    }

    public function rules()
    {
        return [['name', 'required']];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('access_token', \Yii::$app->security->generateRandomString(100));
        }
        return parent::beforeSave($insert);
    }
}
