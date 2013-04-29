<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    
<head>
<title><?php echo $this->pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.10.2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dialogs.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainmenu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/content.css" />


<?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui') ?>

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/helpers.js"></script>

</head>

<body>
    
<div id="page">

<div id="header">

    <div id="logo">
        <img src="images/logo.png" alt="Quisc" />
    </div>

    <div id="profile">

        <? $this->widget('application.components.widget.Profile'); ?>

    </div>

    <div class="clear"></div>
</div><!-- header -->

<div id="content">
    <div id="menubar">
        <?php
            $this->widget('application.components.widget.Menu',array(
                'view' => 'mainmenu',
                'items'=>array(
                    array('label'=>'Overview', 'pattern'=>array('overview'), 'url'=>array('/overview/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Example Project', 'pattern'=>array('project'), 'url'=>array('/project/example')),
                    array('label'=>'Tour', 'pattern'=>array('tour'), 'url'=>array('/tour/overview')),
                    array('label'=>'Management', 'pattern'=>array('management'), 'url'=>array('/management/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Scheduling', 'pattern'=>array('scheduling'), 'url'=>array('/scheduling/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Control', 'pattern'=>array('control'), 'url'=>array('/control/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Home', 'pattern'=>array('guest'), 'url'=>array('/guest/index'), 'visible'=>Yii::app()->user->isGuest),
                ),
            ));
        ?>

    <div class="clear"></div>
    </div>

<?php echo $content; ?>

    <div class="clear"></div>

</div><!-- content -->

<div id="footer">
Copyright &copy; 2013 Mind Kitchen<br/>
</div><!-- footer -->

</div><!-- page -->
</body>

</html>