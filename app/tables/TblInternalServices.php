<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_internal_services".
 *
 * @property int $id
 * @property string $name
 * @property string $access_token
 */
class TblInternalServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_internal_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'access_token'], 'required'],
            [['name', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'access_token' => 'Access Token',
        ];
    }
}
