<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Восстановление пароля';

if ($check === true) {
?>
<div class="site-reset">
	<div class="col-lg-6 col-lg-offset-3 reset">
		<h1>Пароль отправлен на почту</h1>
		<p> Новый пароль отправлен вам на почту</p>
	</div>
	<div class="col-lg-6 col-lg-offset-3">
		<a href="<?=Url::to(['/'])?>" class="btn btn-info btn-block btn-lg">На главную</a>
	</div>
</div>

<?php } else { ?>
<div class="site-reset">
	<div class="col-lg-6 col-lg-offset-3 reset-error">
		<h2><?php echo $check ?></h2>
	</div>
	<div class="col-lg-6 col-lg-offset-3">
		<a href="<?=Url::to(['/'])?>" class="btn btn-info btn-block btn-lg">На главную</a>
	</div>
</div>
<?php }