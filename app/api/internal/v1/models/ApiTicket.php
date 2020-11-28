<?php

namespace app\api\internal\v1\models;

use app\api\common\models\ApiTicketType;
use yii\helpers\ArrayHelper;

class ApiTicket extends \app\api\common\models\ApiTicket
{
    const SCENARIO_EXTERNAL = 'external';

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['type_id', 'checkByType', 'on' => self::SCENARIO_EXTERNAL]
        ]);
    }

    public function checkByType($attribute) {
        $attributes = ApiTicketType::getAttributesById($this->$attribute);
        $emptyAttributes = [];
        foreach ($attributes as $attr) {
            if (!\Yii::$app->request->post($attr)) {
                $emptyAttributes[] = $attr;
            }
        }
        if (!empty($emptyAttributes)) {
            $this->addError($attribute, 'Отсутствуют обязательные переменные для типа: '.implode(", ", $emptyAttributes));
        }
    }

    public function saveByTemplate()
    {
        $template = ApiTicketType::getTemplate($this->type, \Yii::$app->request->post());

        return $this->load($template, '') && $this->save();
    }
}