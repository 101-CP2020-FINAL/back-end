<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket_type".
 *
 * @property int $id
 * @property string $title
 * @property string|null $template
 *
 * @property TblTicket[] $tblTickets
 */
class TblTicketType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['template'], 'safe'],
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
            'template' => 'Template',
        ];
    }

    /**
     * Gets query for [[TblTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTickets()
    {
        return $this->hasMany(TblTicket::className(), ['type_id' => 'id']);
    }
}
