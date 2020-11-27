<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket_employees".
 *
 * @property int $employer_id
 * @property int $ticket_id
 * @property string|null $date_created
 *
 * @property TblEmployer $employer
 * @property TblTicket $ticket
 */
class TblTicketEmployees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket_employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'ticket_id'], 'required'],
            [['employer_id', 'ticket_id'], 'default', 'value' => null],
            [['employer_id', 'ticket_id'], 'integer'],
            [['date_created'], 'safe'],
            [['employer_id', 'ticket_id'], 'unique', 'targetAttribute' => ['employer_id', 'ticket_id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblEmployer::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblTicket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employer_id' => 'Employer ID',
            'ticket_id' => 'Ticket ID',
            'date_created' => 'Date Created',
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
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(TblTicket::className(), ['id' => 'ticket_id']);
    }
}
