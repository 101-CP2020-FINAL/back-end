<?php

namespace app\api\internal\v1;

use yii\base\BootstrapInterface;

class ModuleBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->modules = [
            'api-internal-v1' => [
               'class' => 'app\api\internal\v1\Module',
            ],
        ];

        $pathPrefix = 'api/internal/v1';

        $app->getUrlManager()->addRules([
            'GET ' . $pathPrefix  => 'api-internal-v1/default/index',
            'POST ' . $pathPrefix . '/tickets'  => 'api-internal-v1/tickets/create',
        ], true);
    }
}
