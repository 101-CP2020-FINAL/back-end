<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TicketMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticket-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ticket_id')->dropDownList(\app\models\Ticket::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'employer_id')->dropDownList(\app\models\Employer::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'message_type_id')->dropDownList(\app\models\MessageType::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ])  ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
