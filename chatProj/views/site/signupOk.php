<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Регистрация';
?>
<div class="site-regok">
	<div class="col-lg-6 col-lg-offset-3 regok">
		<h2>Вы успешно зарегистрировались!</h2>
	</div>
	<div class="col-lg-6 col-lg-offset-3">
		<a href="<?=Url::to(['/'])?>" class="btn btn-info btn-block btn-lg">На главную</a>
	</div>
</div>

