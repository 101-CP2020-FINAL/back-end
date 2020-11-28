<?php

namespace app\api\internal\v1\models;

use app\tables\TblTicketType;
use yii\helpers\ArrayHelper;

class ApiTicketType extends TblTicketType
{
    /**
     * @param $id
     * @return array
     */
    public static function getAttributesById($id)
    {
        $type = self::findOne($id);
        if ($type && $type->template) {
            return array_unique(ArrayHelper::merge(
                self::getVars(isset($type->template['title']) ? $type->template['title'] : ''),
                self::getVars(isset($type->template['description']) ? $type->template['description'] : ''),
                ['date_start', 'deadline']
            ));
        }
        return [];
    }

    private static function getVars($str)
    {
        $vars = [];
        $matchVars = [];
        preg_match_all('/{{(\w|_)+}}/', $str, $matchVars);
        if (isset($matchVars[0])) {
            foreach ($matchVars[0] as $var) {
                $vars[] = substr($var, 2, strlen($var) - 4);
            }
        }
        return $vars;
    }
}