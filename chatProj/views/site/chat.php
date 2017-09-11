<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Comments;

$this->title = 'Чат';

$dataProvider = new ActiveDataProvider([
    'query' => Comments::find()->orderBy('date DESC'),
    'pagination' => [
        'pageSize' => 5,
    ],
]);
?>
<div class="site-chat">
	<div class="col-lg-10 col-lg-offset-1">
		<h1 style="text-align:center;">Добро пожаловать в чат!</h1>
		<hr>
	</div>
</div>
<?php
/*$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);*/

$script = <<< JS
function updateMessage(){
        $.pjax.reload({container: '#123'});
    }

    $(document).ready(function(){
        setInterval(updateMessage, 3000);
    });
JS;
$this->registerJs($script);

?>
    
	<?php Pjax::begin(); ?>
	<?php Pjax::begin(['options' => ['id'=>123, 'timeout'=>3000]]); ?>
	<!--/*= Html::a("Обновить", ['site/chat'], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton', 'style' => 'display:none']) */-->
<?php 
	echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_list',
		'summary' => '',
		'emptyText' => '',
		'pager' => [
			
		]
	]);
	?>
	<?php Pjax::end(); ?>
	<?php $form = ActiveForm::begin([
        'id' => 'chat-form',
        'options' => ['class' => 'form-horizontal','data-pjax' => true],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-10 col-lg-offset-1\">{label}</div>\n<div class=\"col-lg-10 col-lg-offset-1\">{input}</div>\n<div class=\"col-lg-12\"><div class=\"col-lg-10 col-lg-offset-1\">{error}</div></div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>
        <?= $form->field($chat_model, 'text')->textArea([
			'rows' => 6,
			'value' => ''
		])->label('Сообщение') ?>

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-1">
                <?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'send-button']) ?>
				<hr>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
	<?php Pjax::end(); ?>
</div>
