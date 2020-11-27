<?php

namespace app\api\mobile\v1;

use yii\base\BootstrapInterface;

class ModuleBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->modules = [
            'api-mobile-v1' => [
               'class' => 'app\api\mobile\v1\Module',
            ],
        ];

        $pathPrefix = 'api/mobile/v1';

        $app->getUrlManager()->addRules([
            'GET ' . $pathPrefix  => 'api-mobile-v1/default/index',
        ], true);
    }
}
