<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Восстановление пароля';
?>
<div class="site-login">
	<div class="col-lg-6 col-lg-offset-3">
		<h1 style="text-align:center;">Восстановление пароля</h1>
	</div>

    <?php $form = ActiveForm::begin([
        'id' => 'reset-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-6 col-lg-offset-3\">{label}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-6 col-lg-offset-3\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

        <?= $form->field($reset_model, 'email')->textInput([
			'autofocus' => true,
		])->label('Введите ваш Email') ?>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3">
                <?= Html::submitButton('Восстановить', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'reset-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
