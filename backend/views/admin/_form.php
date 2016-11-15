<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\admin;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<!--     <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true,'value'=>'']) ?>
    <?= $form->field($model, 'password_hash_repeat')->textInput(['maxlength' => true,'value'=>'']) ?>

<!--   <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Admin::getZhStatus(),['style'=>"width:40%"])?>

   <!--  <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
