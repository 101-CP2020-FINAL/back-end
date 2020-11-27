<?php

namespace app\models;

use app\tables\TblEmployer;
use app\tables\TblEmployerGroup;
use app\tables\TblUser;
use yii\helpers\ArrayHelper;

class Employer extends TblEmployer
{
    public $username;
    public $password;
    public $groups;
    public $title;

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'date_created' => 'Дата создания',
            'username' => 'Логин',
            'password' => 'Пароль',
            'groups' => 'Группы',
            'external_id' => 'Табельный номер сотрудника'
        ];
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['username', 'required'],
            ['password', 'string'],
            ['groups', 'safe']
        ]);
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->select(['id', "CONCAT(first_name, ' ', last_name) AS title"])->all(), 'id', 'title');
    }

    public function getEmployerGroups()
    {
        return implode(", ", ArrayHelper::getColumn(Group::findAll(['id' => ArrayHelper::getColumn($this->tblEmployerGroups, 'group_id')]), 'title'));
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->validate(['username', 'password'])) {
            $user = $this->user ? $this->user : new TblUser();
            if ($user->isNewRecord && !$this->password) {
                $this->addError('password', "Необходимо заполнить «Пароль».");
                return false;
            }

            $user->setAttributes([
                'username' => $this->username,
                'password_hash' => $this->password ? \Yii::$app->security->generatePasswordHash($this->password) : $user->password_hash,
                'date_created' => $user->date_created ? $user->date_created : time()
            ]);

            if ($user->save()) {
                $this->setAttributes(['user_id' => $user->id, 'date_created' => $user->date_created]);
                if (parent::save()) {
                    TblEmployerGroup::deleteAll(['employer_id' => $this->id]);
                    if (is_array($this->groups)) {
                        foreach ($this->groups as $group) {
                            (new TblEmployerGroup([
                                'employer_id' => $this->id,
                                'group_id' => $group
                            ]))->save();
                        }
                    }

                    return true;
                }
            }
        }
        return false;
    }

    public function afterFind()
    {
        $this->username = $this->user ? $this->user->username : '';
        $this->groups = ArrayHelper::getColumn($this->tblEmployerGroups, 'group_id');
        parent::afterFind();
    }

    public function getFio()
    {
        return $this->first_name.' '.$this->last_name;
    }
}