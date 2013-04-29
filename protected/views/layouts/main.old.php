<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title><?php echo $this->pageTitle; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.10.2.css" />

    <?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery.ui') ?>

</head>

<body>


<div id="fb-root"></div>
<script>

    function print_r(arr, level) {
        var print_red_text = "";
        if(!level) level = 0;
        var level_padding = "";
        for(var j=0; j<level+1; j++) level_padding += "    ";
        if(typeof(arr) == 'object') {
            for(var item in arr) {
                var value = arr[item];
                if(typeof(value) == 'object') {
                    print_red_text += level_padding + "'" + item + "' :\n";
                    print_red_text += print_r(value,level+1);
                }
                else
                    print_red_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }

        else  print_red_text = "===>"+arr+"<===("+typeof(arr)+")";
        return print_red_text;
    }

    window.fbAsyncInit = function() {
        // init the FB JS SDK
        FB.init({
            appId      : '444671505610698',                        // App ID from the app dashboard
            channelUrl : '//yaremchuk.testm40.web.immo/longterm/channel.html', // Channel file for x-domain comms
            status     : true,                                 // Check Facebook Login status
            xfbml      : true                                  // Look for social plugins on the page
        });

        // Additional initialization code such as adding Event Listeners goes here

    };


    // Load the SDK asynchronously
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all/debug.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));




</script>




<div id="page">

    <div id="header">

        <div id="logo">
            <img src="images/logo.png" height="60">
        </div>

        <!-- Menu + Profile differs if user authorised or not -->
        <?php
        if(Yii::app()->user->isGuest) $this->renderPartial('/partial/header_guest');
        else $this->renderPartial('/partial/header_logined');
        ?>

        <!--Отсекающий блок-->
        <div style="clear:both"></div>
    </div>

    <div id="content">
        <?php echo $content; ?>
        <!--Отсекающий блок-->
        <div style="clear:both"></div>
    </div><!-- content -->

    <div id="footer">
        Copyright &copy; 2013 Mind Kitchen<br/>
    </div><!-- footer -->

</div><!-- page -->
</body>

</html>