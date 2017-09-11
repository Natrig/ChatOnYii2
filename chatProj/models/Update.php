<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/*Модель редактирования сообщения*/
class Update extends Model
{
    public $text;
	public $user_id;
	
	public function rules()
    {
        return [
			['text', 'required', 'message' => 'Сообщение не может быть пустым'],
        ];
    }
	
	public function getUser()
	{
		return User::findOne(['username' => $this->username]);
	}
	
	public function updateMessage($id) 
	{
		$comments = Comments::find()->where(['id' => $id])->one();
		$comments->text = Html::encode($this->text);
		return $comments->save(); //true or false
	}
}
