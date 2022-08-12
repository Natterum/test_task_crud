<?php

use common\models\Statuses;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    </p>

    <p>
        <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(Statuses::find() -> all (), 'id', 'description')) ?>
    </p>

    <p>
        <?= $form->field($model, 'priority')->textInput(['type' => 'number', 'min' => 1, 'max' => 5]) ?>
    </p>

    <p class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
