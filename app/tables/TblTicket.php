<?php

namespace app\tables;

use Yii;

/**
 * This is the model class for table "tbl_ticket".
 *
 * @property int $id
 * @property int $type_id
 * @property int $priority_id
 * @property string $title
 * @property string|null $description
 * @property string|null $date_created
 * @property int|null $author_id
 * @property string|null $deadline
 * @property string|null $date_start
 * @property int|null $parent_id
 *
 * @property TblTicket $parent
 * @property TblTicket[] $tblTickets
 * @property TblTicketPriority $priority
 * @property TblTicketType $type
 * @property TblTicketEmployees[] $tblTicketEmployees
 * @property TblEmployer[] $employers
 * @property TblTicketFile[] $tblTicketFiles
 * @property TblTicketMessage[] $tblTicketMessages
 */
class TblTicket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'priority_id', 'title'], 'required'],
            [['type_id', 'priority_id', 'author_id', 'parent_id'], 'default', 'value' => null],
            [['type_id', 'priority_id', 'author_id', 'parent_id'], 'integer'],
            [['description'], 'string'],
            [['date_created', 'deadline', 'date_start'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblTicket::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblTicketPriority::className(), 'targetAttribute' => ['priority_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblTicketType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'priority_id' => 'Priority ID',
            'title' => 'Title',
            'description' => 'Description',
            'date_created' => 'Date Created',
            'author_id' => 'Author ID',
            'deadline' => 'Deadline',
            'date_start' => 'Date Start',
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
        return $this->hasOne(TblTicket::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[TblTickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTickets()
    {
        return $this->hasMany(TblTicket::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Priority]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(TblTicketPriority::className(), ['id' => 'priority_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TblTicketType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[TblTicketEmployees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTicketEmployees()
    {
        return $this->hasMany(TblTicketEmployees::className(), ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[Employers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployers()
    {
        return $this->hasMany(TblEmployer::className(), ['id' => 'employer_id'])->viaTable('tbl_ticket_employees', ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[TblTicketFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTicketFiles()
    {
        return $this->hasMany(TblTicketFile::className(), ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[TblTicketMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblTicketMessages()
    {
        return $this->hasMany(TblTicketMessage::className(), ['ticket_id' => 'id']);
    }
}
