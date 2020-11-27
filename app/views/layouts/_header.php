<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini"></span><span class="logo-lg logo-background"><b>РОС</b>АТОМ</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">
                            admin
                        </span>
                    </a>
                    <ul class="dropdown-menu">

                        <li><a href="#" class="">Профиль</a></li>
                        <li><?= Html::a(
                            'Выход',
                            ['/site/logout'],
                            ['data-method' => 'post', 'class' => '']
                        ) ?></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
