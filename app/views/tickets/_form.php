<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(\app\models\TicketType::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'priority_id')->dropDownList(\app\models\TicketPriority::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'author_id')->dropDownList(\app\models\Employer::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'date_start')->textInput([
//        'class' => 'form-control datepicker'
    ]) ?>

    <?= $form->field($model, 'deadline')->textInput([
//            'class' => 'form-control datepicker'
    ]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(\app\models\Ticket::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'employers')->dropDownList(\app\models\Employer::getList(), [
        'class' => 'form-control select2',
        'prompt' => '',
        'multiple' => true
    ])  ?>

    <?= $form->field($model, 'files')->fileInput(['multiple' => true])  ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
