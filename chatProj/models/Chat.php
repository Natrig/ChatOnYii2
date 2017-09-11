<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/*Модель чата*/
class Chat extends Model
{
    public $text;
	public $user_id;
	
	public function rules()
    {
        return [
			['text', 'required', 'message' => 'Введите сообщение для отправки'],
        ];
    }
	
	public function getUser()
	{
		return User::findOne(['username' => $this->username]);
	}
	
	public function getMessage()
	{
		
	}
	
	public function sendMessage() 
	{
		$comments = new Comments();
		$comments->text = Html::encode($this->text);
		$comments->user_id = yii::$app->user->identity->id;
		return $comments->save(); //true or false
	}
}
