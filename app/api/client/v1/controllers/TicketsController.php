<?php

namespace app\api\client\v1\controllers;

use app\api\common\models\ApiTicket;

class TicketsController extends DefaultController
{
    public function actionCreate()
    {
       $model = new ApiTicket();
        $model->load(\Yii::$app->request->post(), '');
        $model->setAttribute('author_id', \Yii::$app->user->id);
        if ($model->validate() && $model->save()) {
                \Yii::$app->response->setStatusCode(201);
                $model->setScenario(ApiTicket::SCENARIO_VIEW);
        }

        return $model;
    }

//    public function
}