<?php

namespace app\api\client\v1;

use yii\base\BootstrapInterface;

class ModuleBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->modules = [
            'api-client-v1' => [
               'class' => 'app\api\client\v1\Module',
            ],
        ];

        $pathPrefix = 'api/client/v1';

        $app->getUrlManager()->addRules([
            'GET ' . $pathPrefix  => 'api-client-v1/default/index',
            'POST ' . $pathPrefix . '/tickets'  => 'api-client-v1/tickets/create',
            'POST ' . $pathPrefix . '/tts'  => 'api-client-v1/tts/index',
        ], true);
    }
}
