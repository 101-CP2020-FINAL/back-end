<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_staff".
 *
 * @property int $id
 * @property int $employer_id
 * @property int $department_id
 * @property int $role_id
 * @property bool|null $lead
 *
 * @property TblDepartment $department
 * @property TblEmployer $employer
 * @property TblRole $role
 */
class TblStaff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'department_id', 'role_id'], 'required'],
            [['employer_id', 'department_id', 'role_id'], 'default', 'value' => null],
            [['employer_id', 'department_id', 'role_id'], 'integer'],
            [['lead'], 'boolean'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepartment::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblEmployer::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblRole::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employer_id' => 'Employer ID',
            'department_id' => 'Department ID',
            'role_id' => 'Role ID',
            'lead' => 'Lead',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(TblDepartment::className(), ['id' => 'department_id']);
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
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(TblRole::className(), ['id' => 'role_id']);
    }
}
