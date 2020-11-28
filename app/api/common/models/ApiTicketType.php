<?php

namespace app\api\common\models;

use app\tables\TblTicketType;
use yii\helpers\ArrayHelper;

class ApiTicketType extends TblTicketType
{
    public static function getTemplate($type, $values = [])
    {
        $attributes = ApiTicketType::getAttributesById($type->id);
        $pattern = [];
        $replacement = [];
        foreach ($attributes as $attribute) {
            $pattern[] = '/{{'.$attribute.'}}/';
            $replacement[] = empty($values) || !isset($values[$attribute]) || !$values[$attribute] ? '______________' : $values[$attribute];
        }
        $template = $type->template;
        foreach ($template as $key => $value) {
            $template[$key] = preg_replace($pattern, $replacement, $value);
        }
        return $template;
    }
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

    public static function getValuesFromText($template, $text)
    {
        $values = [];
        if (isset($template['labels'])) {
            $arr = explode(' ', $text);
            $labels = array_values($template['labels']);
            foreach ($template['labels'] as $attr => $label) {
                $n = 0;
                while ($n < count($arr)) {
                    if ($arr[$n] === $label) {
                        $m = $n + 1;
                        $values[$attr] = [];
                        for ($j = $m; $j < count($arr); $j++) {
                            if (in_array($attr[$j], $labels)) {
                                break;
                            }
                            $values[$attr][] = $arr[$j];
                        }
                    }
                    $n++;
                }
            }
        }
        return array_map(function($item){
            return implode(" ", $item);
        }, $values);
    }
}