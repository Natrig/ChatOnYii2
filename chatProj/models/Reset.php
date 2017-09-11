<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

/*Модель восстановления пароля*/
class Reset extends Model
{
    public $email;
	
	public function rules()
    {
        return [
            [['email'],'required', 'message' => 'Введите email'],
			
			['email','email', 'message' => "Неверно указан email"],
			
			['email', 'validateEmail']
        ];
    }
	
	public function validateEmail($attribute, $params)
	{
		$user = User::find()->where(['email' => $this->email])->one();
		if (!$user) {
			$this->addError($attribute, "Пользователь с таким E-mail не зарегистрирован на сайте.");
        }
	}
	
	public function send()
	{
		$user = User::find()->where(['email' => $this->email])->one();
		
		$restore_link = sha1($user->password);

        $restore_link = base64_encode($user->id.":::".$restore_link.":::".strrev(time()));
		
		$restore_link = "http://".Url::to([$_SERVER['SERVER_NAME']."/site/reset", 'code' => $restore_link]) ;
		$message = "Здравствуйте!<br /><br />
		Вы воспользовались службой восстановления пароля на сайте ".$_SERVER['SERVER_NAME'].".<br /><br />
		Для восстановления пароля перейдите по ссылке <a href=\"$restore_link\">".$restore_link."</a>.";
		Yii::$app->mailer->compose()
		->setFrom('tech.supp.2016@mail.ru')
		->setTo($user->email)
		->setSubject("Восстановление")
		->setHtmlBody($message)
		->send();
		
		return true;
	}
	
	 public function check($params) {
          $restore_code = base64_decode($params);
          $parts = explode(":::", $restore_code);
          $user_id = $parts[0];
          $tsp = strrev($parts[2]);

          if ($tsp < time() - 60 * 60 * 3) {
              return "Ссылка на восстановление пароля действует только три часа.";
          }

          $user = User::find()->where(['id' => $user_id])->one();

          if (!$user->id) {
              return "Пользователь не найден.";
          }
		  
          if ($parts[1] != sha1($user->password)) {
              return "Ссылка некорректна";
          }
		  
          $user->password = substr(uniqid(), 0, 8);
		  
		  $message = "Здравствуйте!<br /><br />
		  Вы воспользовались службой восстановления пароля на сайте ".$_SERVER['SERVER_NAME'].".<br /><br />
		  Новый пароль: ".$user->password;
		  
		  Yii::$app->mailer->compose()
		  ->setFrom('tech.supp.2016@mail.ru')
		  ->setTo($user->email)
		  ->setSubject("Восстановление")
		  ->setHtmlBody($message)
		  ->send();

		  $user->password = sha1($user->password);
          $user->save();
		  
		  return true;
      }
}
