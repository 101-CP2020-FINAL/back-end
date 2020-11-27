<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отделы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"></h3>

            <div class="box-tools">
                <?= Html::a(Html::icon('plus'), ['create'], ['class' => 'btn btn-round btn-success']) ?>
            </div>
        </div>
        <div class="box-body">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'parent.title:text:Родитель',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
    </div>

    <?php Pjax::end(); ?>

</div>
