<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Восстановление пароля';
?>
<div class="site-reset">
	<div class="col-lg-6 col-lg-offset-3 reset">
		<h1>Отправлено сообщение</h1>
		<p> Вам отправлено сообщение со ссылкой на почту, перейдите по ссылке чтобы воостановить пароль</p>
	</div>
	
	<div class="col-lg-6 col-lg-offset-3">
		<a href="<?=Url::to(['/'])?>" class="btn btn-info btn-block btn-lg">На главную</a>
	</div>
</div>
