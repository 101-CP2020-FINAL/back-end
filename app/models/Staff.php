<?php

namespace app\models;

use app\tables\TblStaff;

class Staff extends TblStaff
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employer.fio' => 'Сотрудник',
            'employer_id' => 'Сотрудник',
            'department.title' => 'Отдел',
            'department_id' => 'Отдел',
            'role.title' => 'Роль',
            'role_id' => 'Роль',
            'lead' => 'Главный',
        ];
    }

    public function getEmployer()
    {
        return $this->hasOne(Employer::className(), ['id' => 'employer_id']);
    }
}