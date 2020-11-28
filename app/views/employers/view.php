<?php

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employer */

$this->title = $model->last_name.' '.$model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employer-view">

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
            'first_name',
            'last_name',
            'date_created:datetime',
            'user.username:text:Логин',
            'user.access_token:text:Токен',
            'employerGroups',
            'external_id'
        ],
    ]) ?>
        </div>
    </div>

</div>
