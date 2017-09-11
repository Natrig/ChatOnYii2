<?php

namespace app\models;

use Yii;
use yii\base\Model;

/*Модель регистрации*/
class Signup extends Model
{
    public $username;
    public $password;
	public $repassword;
    public $email;
	public $file;
	

    /*Правила формы*/
    public function rules()
    {
        return [
            
            [['username', 'password', 'repassword', 'email'], 'required', 'message' => 'Не заполнено поле'],
			['email', 'email' , 'message' => 'Не верно указан email'],
			['username','unique','targetClass' => 'app\models\User', 'message' => 'Введенное имя занято'],
            ['password', 'validatePassword'],
			[['file'] , 'file', 'extensions' => 'png,jpg'],
			['file', 'default', 'value' => 'default.png'],
        ];
    }

	/*Валидация Пароля*/
    public function validatePassword($attribute, $params)
    {
        if ($this->password != $this->repassword)
			$this->addError($attribute, 'Пароли не совпадают');
    }
	
	/*Заносим пользователя в БД*/
	public function signup()
	{
		$user = new User();
		$user->email = $this->email;
		$user->setPassword($this->password);
		$user->username = $this->username;
		$user->img = $this->file;
		return $user->save(); //true or false
	}
}
