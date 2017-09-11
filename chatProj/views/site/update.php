<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Comments;

$this->title = 'Чат';

?>
<div class="site-chat">
	<div class="col-lg-10 col-lg-offset-1">
		<h1 style="text-align:center;">Редактирование сообщения</h1>
		<hr>
	</div>
</div>

	<?php $form = ActiveForm::begin([
        'id' => 'update-form',
        'options' => ['class' => 'form-horizontal','data-pjax' => true],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-10 col-lg-offset-1\">{label}</div>\n<div class=\"col-lg-10 col-lg-offset-1\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-10 col-lg-offset-1\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>
        <?= $form->field($update_model, 'text')->textArea([
			'rows' => 15,
			'value' => "$defaultText"
		])->label('Сообщение') ?>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-1">
                <?= Html::submitButton('Отредактировать сообщение', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'update-button']) ?>
				<hr>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
