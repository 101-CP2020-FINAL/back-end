<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employer_id')->dropDownList(\app\models\Employer::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(\app\models\Department::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ]) ?>

    <?= $form->field($model, 'role_id')->dropDownList(\app\models\Role::getList(), [
        'class' => 'form-control select2',
        'prompt' => ''
    ]) ?>

    <?= $form->field($model, 'lead')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
