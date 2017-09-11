<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use app\models\User;


$User = User::find()
->where(['id' => HtmlPurifier::process($model->user_id)])
->one();

$hours = date("H:i", strtotime($model->date));
$model->date = date("d.m.Y", strtotime($model->date));
?>

<div class="col-lg-10 col-lg-offset-1 users_message">
		<p class="message_date">
			Время:<b><?=HtmlPurifier::process($hours)?></b>
			Дата:<b><?=HtmlPurifier::process($model->date)?></b>
		</p>
		<div class="user_img left">
			<img width="100" height="80" src="/photo/<?=$User->img;?>"></img>
		</div>
		<span class="username_chat left">
			<?=$User->username;?>
		</span><br><br>
		<div class="chat_message">
			<p>
				<?= HtmlPurifier::process($model->text) ?> 
			</p>
		</div>
		<?php if (yii::$app->user->identity->id == HtmlPurifier::process($model->user_id)) 
		{
		?>
		<div class="right">
			<div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				Действие <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="<?=Url::to(['site/update', 'id' => $model->id])?>" id="UpdateMessage">Редактировать</a></li>			  
				  <li><a href="<?=Url::to(['site/delete', 'id' => $model->id])?>" onclick="return confirm('Вы действ. хотите удалить сообщ.?');">Удалить</a></li>
				</ul>
			  </div>
		</div>
		<?php
		} 
		?>
</div>