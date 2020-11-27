<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);

$bundle = app\assets\AppAsset::register($this);
$path = $bundle->baseUrl;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-purple-light sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render('_header', [
            'path' => $path
        ]) ?>

        <?= $this->render('_left') ?>

        <?= $this->render('_content', [
            'content' => $content
        ]) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
