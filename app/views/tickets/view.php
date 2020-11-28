<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="role-view">

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title"></h3>

            <div class="box-tools">
                <?= Html::a(Html::icon('pencil'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Html::icon('trash'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, чтоб хотите удалить этот элемент?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'type.title',
            'priority.title',
            'parent.title',
            'author',
            'employersStr',
            'date_start:datetime',
            'deadline:datetime',
            'date_created:datetime',
            'description:ntext',
            [
                'header' => 'Файлы',
                'attribute' => 'files',
                'value' => function($model){
                    $result = '';
                    foreach ($model->tblTicketFiles as $file) {
                        $result .= Html::a($file->path, $file->path, ['target' => '_blank']).'<br>';
                    }
                    return $result;
                },
                'format' => 'raw'
            ]
        ],
    ]) ?>
        </div>
    </div>

</div>
