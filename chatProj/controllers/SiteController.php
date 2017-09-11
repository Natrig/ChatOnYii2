<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\Signup;
use app\models\Comments;
use app\models\Login;
use app\models\Edit;
use app\models\Chat;
use app\models\Update;
use app\models\Reset;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /*Контроллер по умолчанию*/
    public function actionIndex()
    {
		if (\Yii::$app->user->isGuest) {
			return $this->render('index');
		} else {
			Yii::$app->response->redirect('/site/chat');
		}
    }
	
	public function actionBill()
    {
		if (\Yii::$app->user->isGuest) {
			return $this->render('bill');
		} else {
			Yii::$app->response->redirect('/site/bill');
		}
    }
	
	public function actionAct()
    {
		if (\Yii::$app->user->isGuest) {
			return $this->render('act');
		} else {
			Yii::$app->response->redirect('/site/act');
		}
    }
	
	public function actionLogout()
	{
		if (!Yii::$app->user->isGuest)
		{
			Yii::$app->user->logout();
			return $this->goHome();
		}
	}
	
	/*Контроллер регистрации*/
	public function actionSignup() 
	{
		/*Проверка если пользователь авторизован*/
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		$model = new Signup();
		
		if($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->file = UploadedFile::getInstance($model, 'file');
			if ($model->file) {
				$model->file->saveAs("photo/".$model->file->baseName.".".$model->file->extension);
			} else {
				$model->file = 'default.png';
			}
			if($model->signup())
				return $this->render('signupOk');
		}
		
		return $this->render('signup', [
			'model' => $model,
		]);
	}
	
	public function actionLogin() 
	{
		/*Проверка если пользователь авторизован*/
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		$login_model = new Login();
		
		if (Yii::$app->request->post('Login'))
		{
			$login_model->attributes = Yii::$app->request->post('Login');
			
			if($login_model->validate())
			{
				Yii::$app->user->login($login_model->getUser());
				return $this->goHome();
			}
		}
		
		return $this->render('login', [
			'login_model' => $login_model,
		]);
	}
	
	public function actionEdit()
	{
		/*Проверка если пользователь авторизован*/
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		$edit_model = new Edit();
		
		if($edit_model->load(Yii::$app->request->post()) && $edit_model->validate()) {
			$edit_model->file = UploadedFile::getInstance($edit_model, 'file');
			if ($edit_model->file) {
				$edit_model->file->saveAs("photo/".$edit_model->file->baseName.".".$edit_model->file->extension);
			} else {
				$edit_model->file = yii::$app->user->identity->img;
			}
			$edit_model->editProfile();
			return $this->redirect(['edit']);
		}
		
		return $this->render('edit', [
			'edit_model' => $edit_model,
		]);
	}
	
	public function actionChat()
	{
		/*Проверка если пользователь авторизован*/
		if (\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		$chat_model = new Chat();
		
		if(isset($_POST['Chat'])) {
			$chat_model->attributes = Yii::$app->request->post("Chat");
			
			if ($chat_model->validate()) {
				$chat_model->sendMessage();
			}
		}
		
		return $this->render('chat', [
			'chat_model' => $chat_model,
		]);
	}
	
	public function actionDelete($id = false)
    {
        if (isset($id)) {
            if (Comments::deleteAll(['in', 'id', $id])) {
                $this->goHome();
            }
        } else {
            $this->goHome();
        }
    }
	
	public function actionUpdate($id = false)
    {	
        if (isset($id)) {
			$query = Comments::find()->where(['id' => $id])->one();
			if ($query->user_id == yii::$app->user->identity->id) {
		
				$update_model = new Update();
				
				if(isset($_POST['Update'])) {
					$update_model->attributes = Yii::$app->request->post("Update");
					
					if ($update_model->validate()) {
						$update_model->updateMessage($id);
						$this->goHome();
					}
				}
				
				return $this->render('update', [
					'update_model' => $update_model,
					'defaultText' => $query->text,
				]);
			} else {
				$this->goHome();
			}
        } else {
			$this->goHome();
        }
    }
	
	public function actionReset($code = false)
    {
		/*Проверка если пользователь авторизован*/
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}
		
		$reset_model = new Reset();
		
		if(isset($_POST['Reset'])) {
			$reset_model->attributes = Yii::$app->request->post('Reset');
			if ($reset_model->validate())
				$reset_model->send();
				return $this->render('resetSend');
		}
		
		if($code) {
			$check = $reset_model->check($code);
			
			if ($check === 1) {
				return $this->render('resetOk');
			} else {
				return $this->render('resetOk',[
					'check' => $check
				]);
			}
		}
		
        return $this->render('reset', [
			'reset_model' => $reset_model
		]);
    }
}
