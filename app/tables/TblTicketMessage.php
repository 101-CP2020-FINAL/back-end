<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket_message".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int|null $employer_id
 * @property int $message_type_id
 * @property string $message
 * @property string|null $date_created
 *
 * @property TblEmployer $employer
 * @property TblMessageType $messageType
 * @property TblTicket $ticket
 */
class TblTicketMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'message_type_id', 'message'], 'required'],
            [['ticket_id', 'employer_id', 'message_type_id'], 'default', 'value' => null],
            [['ticket_id', 'employer_id', 'message_type_id'], 'integer'],
            [['message'], 'string'],
            [['date_created'], 'safe'],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblEmployer::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['message_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblMessageType::className(), 'targetAttribute' => ['message_type_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblTicket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'employer_id' => 'Employer ID',
            'message_type_id' => 'Message Type ID',
            'message' => 'Message',
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
     * Gets query for [[MessageType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessageType()
    {
        return $this->hasOne(TblMessageType::className(), ['id' => 'message_type_id']);
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
