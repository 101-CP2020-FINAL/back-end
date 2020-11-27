<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_message_type".
 *
 * @property int $id
 * @property string $title
 *
 * @property TblTicketMessage[] $tblTicketMessages
 */
class TblMessageType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_message_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[TblTicketMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTicketMessages()
    {
        return $this->hasMany(TblTicketMessage::className(), ['message_type_id' => 'id']);
    }
}
