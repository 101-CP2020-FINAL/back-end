<?php

namespace app\api\manager\v1;

use yii\base\BootstrapInterface;

class ModuleBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->modules = [
            'api-manager-v1' => [
               'class' => 'app\api\manager\v1\Module',
            ],
        ];

        $pathPrefix = 'api/manager/v1';

        $app->getUrlManager()->addRules([
            'GET ' . $pathPrefix  => 'api-manager-v1/default/index',
        ], true);
    }
}
