<?php

namespace app\api\client\v1\models;

class ApiTicketType extends \app\api\common\models\ApiTicketType
{
    public function fields()
    {
        return [
            'id',
            'title'
        ];
    }
}