<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class FacebookIdentity extends CUserIdentity
{
    
    const ENUMNAME = 'FACEBOOK';
    const SAVE_USER_ERROR = 10;
    
    private $_facebookResponse;   
    private $_id;

    public $errors;
    
    public function __construct($facebookResponse)
    {
        $this->_facebookResponse = $facebookResponse;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function authenticate()
    {
        $this->errorCode=self::ERROR_NONE;
        $user = User::model()->find('ext_user_id = :param', array(':param' => $this->_facebookResponse['id']));
        if(is_null($user))
        {            
            //Если не нашли то создаем такого пользователя        
            $user = new User('facebook');
            $user->user_id = Randomness::getGUID();
            $user->email ='face@face.fa';
            $user->firstname = $this->_facebookResponse['first_name'];
            $user->lastname = $this->_facebookResponse['last_name'];         
            $user->ext_user_id = $this->_facebookResponse['id']; 
            $user->service = self::ENUMNAME;
            $user->picture = false;
            $user->private = false;
            $res = $user->save();
            if (!$res)
            {
                $this->errorCode = self::SAVE_USER_ERROR;
                $this->errors = $user->errors;
            }
        }
        
        $this->_id = $user->user_id;

        return !$this->errorCode;
    }
}