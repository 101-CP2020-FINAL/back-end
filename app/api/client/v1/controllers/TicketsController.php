<?php

namespace app\api\client\v1\controllers;

use app\api\client\v1\models\ApiTicketPriority;
use app\api\common\models\ApiTicket;
use app\api\common\models\ApiTicketType;
use app\components\CentrifugoHelper;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class TicketsController extends DefaultController
{
    public function actionCreate()
    {
       $model = new ApiTicket();
        $model->load(\Yii::$app->request->post(), '');
//        $model->setAttribute('author_id', \Yii::$app->user->id);
        if ($model->validate() && $model->save()) {
                \Yii::$app->response->setStatusCode(201);
                $model->setScenario(ApiTicket::SCENARIO_VIEW);
                CentrifugoHelper::send(ArrayHelper::toArray($model));
        }

        return $model;
    }

    public function actionTemplate($type = null, $text = null)
    {
        if (!$type && !$text) {
            throw new BadRequestHttpException('Задайте тип или текст');
        }
        if ($type) {
            $type = ApiTicketType::findOne($type);
            if (!$type) {
                throw new BadRequestHttpException('Неверный тип');
            }

            if ($type->template) {
                return ApiTicketType::getTemplate($type);
            }
        }

        if ($text) {
            $types = ApiTicketType::find()->all();
            $text = mb_strtolower($text);
            foreach ($types as $ticketType) {
                if (stripos($text, mb_strtolower($ticketType->title)) !== false) {
                    if ($ticketType->template) {
                        return ApiTicketType::getTemplate($ticketType, ApiTicketType::getValuesFromText($ticketType->template, $text));
                    }
                    return [];
                }
            }
        }
        return [];
    }

    public function actionIndex()
    {
        return ApiTicket::find()->joinWith('priority')->orderBy(['tbl_ticket_priority.weight' => SORT_DESC])->all();
    }

    public function actionDictionaries()
    {
        return [
            'priorities' => ApiTicketPriority::find()->all(),
            'types' => \app\api\client\v1\models\ApiTicketType::find()->all()
        ];
    }
}