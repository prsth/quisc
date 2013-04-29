<?php

class Profile extends CWidget
{
    public $items=array();
    public $view = 'menu';

    public function run()
    {

        $user = User::model()->find('user_id = :userid', array(':userid'=>Yii::app()->user->id));

        if (Yii::app()->user->isGuest) {
            $this->render('profile_guest');
            $this->render('application.components.widget.views.dialogs.login');
//            $this->render('application.components.widget.views.dialogs.register');
        } else {
            $this->render('profile_logined', array('user'=>$user));
        }

//        $items=array();
//        $controller=$this->controller;
//        $action=$controller->action;
//        foreach($this->items as $item)
//        {
//            if(isset($item['visible']) && !$item['visible'])
//                continue;
//            $item2=array();
//            $item2['label']=$item['label'];
//            if(is_array($item['url']))
//                $item2['url']=$controller->createUrl($item['url'][0]);
//            else
//                $item2['url']=$item['url'];
//            $pattern=isset($item['pattern'])?$item['pattern']:$item['url'];
//            $item2['active']=$this->isActive($pattern,$controller->uniqueID,$action->id);
//            $items[]=$item2;
//        }
//        $this->render($this->view, array('items'=>$items));
    }


}