<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dialogs.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dialog.js"></script>

<div id="profile">
    <img id="login_button" src="images/login.png">
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


<?php $this->renderPartial('/partial/dialog_login');?>
<?php $this->renderPartial('/partial/dialog_register');?>