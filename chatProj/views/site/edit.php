<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование';
$imgUrl = '/photo/'.yii::$app->user->identity->img;
?>
<div class="site-registration">
	<div class="col-lg-6 col-lg-offset-3">
		<h1 style="text-align:center;">Редактирование профиля</h1>
	</div>
	
	<div class="col-lg-6 col-lg-offset-4">
		<img src="<?=$imgUrl?>" width="300" height="200"></img>
	</div>
	<hr class="col-lg-6 col-lg-offset-3">
    <?php $form = ActiveForm::begin([
        'id' => 'edit-form',
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-6 col-lg-offset-3\">{label}</div>\n<div class=\"col-lg-6 col-lg-offset-3\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-6 col-lg-offset-3\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>
		<?= $form->field($edit_model, 'file')->fileInput([
			'value' => yii::$app->user->identity->img,
		])->label('Аватар') ?>
		
        <?= $form->field($edit_model, 'username')->textInput([
			'autofocus' => true,
			'value' => yii::$app->user->identity->username,
		])->label('Имя пользователя') ?>
		<?= $form->field($edit_model, 'email')->textInput([
			'value' => yii::$app->user->identity->email,
		])->label('Почта') ?>

        <div class="form-group">
            <div class="col-lg-6 col-lg-offset-3">
                <?= Html::submitButton('Отредактировать', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
