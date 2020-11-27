<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_employer_group".
 *
 * @property int $employer_id
 * @property int $group_id
 *
 * @property TblEmployer $employer
 * @property TblGroup $group
 */
class TblEmployerGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_employer_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'group_id'], 'required'],
            [['employer_id', 'group_id'], 'default', 'value' => null],
            [['employer_id', 'group_id'], 'integer'],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblEmployer::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employer_id' => 'Employer ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(TblEmployer::className(), ['id' => 'employer_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(TblGroup::className(), ['id' => 'group_id']);
    }
}
