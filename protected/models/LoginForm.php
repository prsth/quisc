<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, password', 'required', 'message'=>'{attribute} не может быть пустым'),
            array('email', 'email', 'message'=>'Укажите свою действующую почту'),

            array('verifyCode', 'captcha'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'E-mail',
            'password' => 'Пароль'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new DirectIdentity($this->email,$this->password);
			$identity->authenticate();
			switch($identity->errorCode)
			{
				case DirectIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
					Yii::app()->user->login($identity,$duration);
					break;
				case DirectIdentity::ERROR_USERNAME_INVALID:
					$this->addError('email','Пользователя не существует');
					break;
                case DirectIdentity::ERROR_PASSWORD_NOT_SET:
                    $this->addError('password','Пароль не задан. Войдите через соцсети');
                    break;
				default: // DirectIdentity::ERROR_PASSWORD_INVALID
					$this->addError('password','Неверный пароль');
					break;
			}
		}
	}
}
