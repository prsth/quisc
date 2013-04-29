<?php

/**
 * This is the model class for table "team".
 */
class Team extends CActiveRecord
{
    
        public $logo;
    
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
		return 'team';
	}
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            return array(
                array('name, info', 'required'),
                array('name', 'length', 'min'=>3),
                array('info', 'length', 'min'=>10),                
            );
	}

    public function getAttributesForGrid($attributesmask = 255)
    {

    }

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::MANY_MANY, 'User', 'user_team(user_id,team_id)'),
        );
    }



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            return array(
                'name'=>'Name*',
                'info'=>'Information*',
                'private'=>'Is private?',
                'logo'=>'Company Logo'
            );
	}
        
    public function beforeSave() {
        if(!isset($this->team_id))
            $this->team_id=Randomness::getGUID();
        return parent::beforeSave();
    }
}