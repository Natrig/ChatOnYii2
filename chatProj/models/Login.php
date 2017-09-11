<?php

namespace app\models;

use Yii;
use yii\base\Model;

/*Модель регистрации*/
class Login extends Model
{
    public $username;
	public $password;
	
	public function rules()
    {
        return [
            
            [['username', 'password'], 'required', 'message' => 'Не заполнено поле'],
			
			['password', 'validatePassword'],
        ];
    }
	
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) //если нет ошибок в валидации
		{
			$user = $this->getUser(); // получаем пользователя
		
			if (!$user || !$user->validatePassword($this->password)) 
			{
				//если пользовател не найден в БД
				//или пароль не совпадает
				$this->addError($attribute, 'Неверный логин или пароль');
			}
		}
	}
	
	public function getUser()
	{
		return User::findOne(['username' => $this->username]);
	}
	
	
}
