<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket_priority".
 *
 * @property int $id
 * @property string $title
 * @property int $weight
 *
 * @property TblTicket[] $tblTickets
 */
class TblTicketPriority extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket_priority';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'weight'], 'required'],
            [['weight'], 'default', 'value' => null],
            [['weight'], 'integer'],
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
            'weight' => 'Weight',
        ];
    }

    /**
     * Gets query for [[TblTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTickets()
    {
        return $this->hasMany(TblTicket::className(), ['priority_id' => 'id']);
    }
}
