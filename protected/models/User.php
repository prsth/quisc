<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $user_id
 * @property string $login
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}
        
    public function validatePassword($password)
    {
         return crypt($password,$this->password)===$this->password;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array( 
                array('email, firstname, lastname', 'required'),
                array('email', 'email'),
                array('password, firstname, lastname', 'length', 'max'=>100),
                array('email', 'length', 'max'=>50),

                //Direct insert
                array('password', 'required', 'on'=>'direct'),
                array('password', 'length', 'min'=>5, 'on'=>'direct'),
                array('email','unique', 'message'=>'User with {attribute} {value} is already registered', 'on'=>'direct'),

                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('user_id, password, firstname, lastname, email', 'safe', 'on'=>'search'),
            );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'team' => array(self::MANY_MANY, 'Team', 'user_team(user_id,team_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',		
			'password' => 'Password',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}