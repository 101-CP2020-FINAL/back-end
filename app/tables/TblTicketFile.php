<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket_file".
 *
 * @property int $id
 * @property int $ticket_id
 * @property string $path
 * @property string|null $date_created
 *
 * @property TblTicket $ticket
 */
class TblTicketFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'path'], 'required'],
            [['ticket_id'], 'default', 'value' => null],
            [['ticket_id'], 'integer'],
            [['date_created'], 'safe'],
            [['path'], 'string', 'max' => 255],
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
            'path' => 'Path',
            'date_created' => 'Date Created',
        ];
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
