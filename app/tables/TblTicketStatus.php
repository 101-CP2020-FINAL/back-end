<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket_status".
 *
 * @property int $id
 * @property string $alias
 * @property string $title
 *
 * @property TblTicket[] $tblTickets
 */
class TblTicketStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'title'], 'required'],
            [['alias', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[TblTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTickets()
    {
        return $this->hasMany(TblTicket::className(), ['status_id' => 'id']);
    }
}
