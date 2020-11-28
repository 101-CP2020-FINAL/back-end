<?php

namespace app\api\internal\v1\controllers;

use app\api\internal\v1\models\ApiTicket;

class TicketsController extends DefaultController
{
    public function actionCreate()
    {
       $model = new ApiTicket(['scenario' => ApiTicket::SCENARIO_EXTERNAL]);
        $model->load(\Yii::$app->request->post(), '');
        $model->setAttribute('author_id', \Yii::$app->user->id);
        if ($model->validate(['type_id']) && $model->saveByTemplate()) {
                \Yii::$app->response->setStatusCode(201);
                $model->setScenario(ApiTicket::SCENARIO_VIEW);
        }

        return $model;
    }
}