<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_department".
 *
 * @property int $id
 * @property string $title
 * @property int|null $parent_id
 *
 * @property TblDepartment $parent
 * @property TblDepartment[] $tblDepartments
 * @property TblStaff[] $tblStaff
 */
class TblDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id'], 'default', 'value' => null],
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepartment::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(TblDepartment::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[TblDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblDepartments()
    {
        return $this->hasMany(TblDepartment::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[TblStaff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStaff()
    {
        return $this->hasMany(TblStaff::className(), ['department_id' => 'id']);
    }
}
