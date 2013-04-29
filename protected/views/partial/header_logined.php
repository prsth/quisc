<div id="profile">
    <a href="?r=guest/logout"><img id="logout_button" src="images/logout.png"></a>
</div>

<?php
    $this->widget('application.components.MainMenu',array(
            'items'=>array(
                    array('label'=>'Home', 'url'=>array('/guest/index'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Overview', 'url'=>array('/overview/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Tour', 'url'=>array('/tour/overview')),
                    array('label'=>'Example Project', 'url'=>array('/project/example')),
                    array('label'=>'Scheduling', 'url'=>array('/scheduling/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Control', 'url'=>array('/control/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Management', 'url'=>array('/management/index'), 'visible'=>!Yii::app()->user->isGuest),                
            ),
    ));

?>


