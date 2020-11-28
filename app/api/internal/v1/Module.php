<?php

namespace app\api\internal\v1;

use Yii;
use yii\web\Response;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\api\internal\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->set('user', [
            'class' => 'yii\web\User',
            'identityClass'  => 'app\api\internal\v1\models\ApiInternalService',
            'enableSession' => false
        ]);

        Yii::$app->request->parsers = ['application/json' => 'yii\web\JsonParser'];
        Yii::$app->request->enableCookieValidation = false;

        Yii::$app->response->formatters = [
            Response::FORMAT_JSON => [
                'class' => 'yii\web\JsonResponseFormatter',
                'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ],
        ];

        \Yii::$app->response->headers->add('Access-Control-Allow-Origin', '*');
    }
}
