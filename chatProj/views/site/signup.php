<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>
<div class="site-registration">
	<div class="col-lg-6 col-lg-offset-3">
		<h1 style="text-align:center;">Заполните поля для регистрации</h1>
	</div>

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-6 col-lg-offset-3\">{label}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-6 col-lg-offset-3\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput([
			'autofocus' => true,
		])->label('Имя пользователя') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
		<?= $form->field($model, 'repassword')->passwordInput()->label('Повторите пароль') ?>
		<?= $form->field($model, 'email')->input('email')->label('Почта') ?>
		<?= $form->field($model, 'file')->fileInput()->label('Аватар') ?>


        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
