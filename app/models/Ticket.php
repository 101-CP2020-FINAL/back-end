<?php

namespace app\models;

use app\tables\TblTicket;
use app\tables\TblTicketEmployees;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Ticket extends TblTicket
{
    public $employers;
    public $files;

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Тип задачи',
            'type.title' => 'Тип задачи',
            'priority_id' => 'Приоритет',
            'priority.title' => 'Приоритет',
            'title' => 'Название',
            'description' => 'Описание',
            'date_created' => 'Дата создания',
            'author_id' => 'Создатель',
            'author.fio' => 'Создатель',
            'deadline' => 'Срок окончания',
            'date_start' => 'Дата начала',
            'parent_id' => 'Родитель',
            'parent.title' => 'Родитель',
            'employers' => 'Исполнители',
            'employersStr' => 'Исполнители',
            'files' => 'Файлы'
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['employers', 'files'], 'safe'],
            ['files', 'file',  'maxFiles' => 10]
        ]);
    }

    public function parseDates()
    {
        $this->deadline = implode("-", array_reverse(explode(".", $this->deadline)));
        $this->date_start = implode("-", array_reverse(explode(".", $this->date_start)));
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->validate()) {
//            $this->parseDates();
            if (parent::save($runValidation, $attributeNames)) {
                if (!is_array($this->employers)) {
                    $this->employers = [];
                }
                TblTicketEmployees::deleteAll(['AND', ['NOT IN', 'employer_id', $this->employers], ['ticket_id' => $this->id]]);
                foreach ($this->employers as $employer) {
                    if (!TblTicketEmployees::find()->where(['ticket_id' => $this->id, 'employer_id' => $employer])->count()) {
                        ((new TblTicketEmployees([
                            'ticket_id' => $this->id,
                            'employer_id' => $employer
                        ])))->save();
                    }
                }

                $files = UploadedFile::getInstances($this, 'files');
                if (is_array($files)) {
                    foreach ($files as $file) {
                        TicketFile::saveFile($this->id, $file);
                    }
                }
                return true;
            }
        }
        return false;
    }

    public function getEmployersStr()
    {
        return implode(", ", ArrayHelper::getColumn(
            Employer::find()->select(["CONCAT(first_name, ' ', last_name) AS title"])->where(["id" => ArrayHelper::getColumn($this->tblTicketEmployees, 'employer_id')])->all(),"title"));
    }

    public function afterFind()
    {
        $this->employers = ArrayHelper::getColumn($this->tblTicketEmployees, 'employer_id');
        parent::afterFind();
    }

    public function getAuthor()
    {
        return $this->hasOne(Employer::className(), ['id' => 'author_id']);
    }
}