<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class DirectIdentity extends CUserIdentity
{
    private $_id;

    const ERROR_PASSWORD_NOT_SET = 1001;

    public function getId()
    {
        return $this->_id;
    }

    public function authenticate()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(email)=?',array($username));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(empty($user->password))
        {
            $this->errorCode=self::ERROR_PASSWORD_NOT_SET;
        }
        else if(!$user->validatePassword($this->password))
        {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->_id=$user->user_id;
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
}