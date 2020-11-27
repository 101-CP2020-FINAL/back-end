<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_group".
 *
 * @property int $id
 * @property string $title
 *
 * @property TblEmployerGroup[] $tblEmployerGroups
 */
class TblGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[TblEmployerGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblEmployerGroups()
    {
        return $this->hasMany(TblEmployerGroup::className(), ['group_id' => 'id']);
    }
}
