<?php

namespace app\api\internal\v1\models;

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
        $attributes = ApiTicketType::getAttributesById($this->type_id);
        $pattern = [];
        $replacement = [];
        foreach ($attributes as $attribute) {
            $pattern[] = '/{{'.$attribute.'}}/';
            $replacement[] = \Yii::$app->request->post($attribute);
        }
        $template = $this->type->template;
        foreach ($template as $key => $value) {
            $template[$key] = preg_replace($pattern, $replacement, $value);
        }

        return $this->load($template, '') && $this->save();
    }
}