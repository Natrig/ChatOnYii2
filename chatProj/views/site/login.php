<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
?>
<div class="site-login">
	<div class="col-lg-6 col-lg-offset-3">
		<h1 style="text-align:center;">Заполните поля для входа</h1>
	</div>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-6 col-lg-offset-3\">{label}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-6 col-lg-offset-3\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

        <?= $form->field($login_model, 'username')->textInput([
			'autofocus' => true,
		])->label('Имя пользователя') ?>

        <?= $form->field($login_model, 'password')->passwordInput()->label('Пароль') ?>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
	<div class="col-lg-6 col-lg-offset-3">
		<a href="<?=Url::to(['site/reset'])?>">Забыли пароль?</a>
	</div>
</div>
