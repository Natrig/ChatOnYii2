<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/*Модель редактирования пользователя*/
class Edit extends Model
{
    public $username;
	public $email;
	public $file;
	
	public function rules()
    {
        return [	
			['email', 'email' , 'message' => 'Не верно указан email'],
			['username','unique','targetClass' => 'app\models\User','filter' => ['!=', 'username', yii::$app->user->identity->username] , 'message' => 'Введенное имя занято'],
			[['file'] , 'file', 'extensions' => 'png,jpg'],
        ];
    }
	
	public function getUser()
	{
		return User::findOne(['username' => yii::$app->user->identity->username]);
	}
	
	public function editProfile()
	{
		$user = $this->getUser();
		$user->username = $this->username;
		$user->email = $this->email;
		$user->img = $this->file;
		return $user->save();
	}

}
