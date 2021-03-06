<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_employer".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property int|null $external_id
 * @property int|null $date_created
 *
 * @property TblUser $user
 * @property TblEmployerGroup[] $tblEmployerGroups
 * @property TblStaff[] $tblStaff
 * @property TblTicketEmployees[] $tblTicketEmployees
 * @property TblTicket[] $tickets
 * @property TblTicketMessage[] $tblTicketMessages
 */
class TblEmployer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_employer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required'],
            [['user_id', 'external_id', 'date_created'], 'default', 'value' => null],
            [['user_id', 'external_id', 'date_created'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'external_id' => 'External ID',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[TblEmployerGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblEmployerGroups()
    {
        return $this->hasMany(TblEmployerGroup::className(), ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[TblStaff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblStaff()
    {
        return $this->hasMany(TblStaff::className(), ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[TblTicketEmployees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTicketEmployees()
    {
        return $this->hasMany(TblTicketEmployees::className(), ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(TblTicket::className(), ['id' => 'ticket_id'])->viaTable('tbl_ticket_employees', ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[TblTicketMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTicketMessages()
    {
        return $this->hasMany(TblTicketMessage::className(), ['employer_id' => 'id']);
    }
}
