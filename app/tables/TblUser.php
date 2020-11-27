<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string|null $access_token
 * @property int|null $date_created
 *
 * @property TblEmployer[] $tblEmployers
 */
class TblUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['date_created'], 'default', 'value' => null],
            [['date_created'], 'integer'],
            [['username', 'password_hash', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'access_token' => 'Access Token',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[TblEmployers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblEmployers()
    {
        return $this->hasMany(TblEmployer::className(), ['user_id' => 'id']);
    }
}
