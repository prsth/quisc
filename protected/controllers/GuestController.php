<?php

class GuestController extends CController
{
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
            $this->render('index');
	}

    public function actions()
    {
        return array(
            'captcha' => 'CCaptchaAction'
        );
    }


        /*
         * Регистрация через внутреннюю форму
         */
    public function actionRegisterAjax()
    {
        $user = new User();
        $user->user_id = Randomness::getGUID();
        $user->email = $_REQUEST['User']['email'];
        $user->password = crypt($_REQUEST['User']['password'], Randomness::blowfishSalt());
        $user->firstname = $_REQUEST['User']['firstname'];
        $user->lastname = $_REQUEST['User']['lastname'];
        $user->picture = false;
        $user->private = false;

        $result = $user->save(false);

        $identity = new DirectIdentity($user->email, $_REQUEST['User']['password']);
        if($identity->authenticate())
        {
            Yii::app()->user->login($identity);
            echo json_encode(array('code' => null));
        }
        else
            echo json_encode(array('code' => $identity->errorCode));
    }

    public function actionValidateRegistrationForm()
    {
        $model = new User('register');

        echo CActiveForm::validate($model);
        Yii::app()->end();
    }

    public function actionLoginDirectAjax()
    {

        $loginForm = new LoginForm();

        if (!isset($_REQUEST['LoginForm'])) {
            echo json_encode(array('code' => 1000));
            Yii::app()->end();
        }

        $loginForm->attributes = $_REQUEST['LoginForm'];

        $result = CActiveForm::validate($loginForm);
        if ($result == '[]') {
            echo json_encode(array('code' => null));
            Yii::app()->end();
        }

        $errors = json_decode($result);
        echo json_encode(array('code' => 1000, 'errors'=>$errors, 'form'=>'loginForm'));
    }
        
        /*
         * Вход через фейсбук
         */
    public function actionLoginFacebookAjax()
    {
        $identity = new FacebookIdentity($_REQUEST['response']);
        if($identity->authenticate())
        {
            Yii::app()->user->login($identity);
            echo json_encode(array('code' => null));
        }
        else
            echo json_encode(array('code' => $identity->errorCode, 'errors' => $identity->errors));
    }
        
        
        
        public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}            
    
}