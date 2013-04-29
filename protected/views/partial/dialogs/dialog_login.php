<?php
    /*  Окно диалога LOGIN. По умолчанию скрыто.
     * Показывается через JS. Регистрируется при загрузке.
     */
?>

<script>
    $(function(){
        $('#fbimage').click(function(){
            
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    //Надо просто залогинить
                    FB.api('/me?fields=id,first_name,last_name,email',function(response){
                         $.ajax({
//                                'url': '?r=guest/loginAjax',
                            'type' : 'POST',
                            'success': function(data, textStatus, jqXHR) {
                                //Если верунло 1 значит юзер залогинен
                                if(jqXHR.responseText.code == null)
                                {
                                    dialogStack.closeAll();
                                    window.location = "";
                                }
                            },
                            'data': {
                                'r' : 'guest/loginFacebookAjax',
                                'response' : response
                            }
                        })
                    });                   
                }
                else
                {
                    //Надо регистрировать
                    FB.login(function(response) {
                        if (response.authResponse) {
                           FB.api('/me?fields=id,first_name,last_name,email',function(response){
                               alert(print_r(response));
                           });
                            $.ajax({
//                                'url': '?r=guest/loginAjax',
                                'type' : 'POST',
                                'complete': 'test',
                                'data': {
                                    'r' : 'guest/loginFacebookAjax',
                                    'response' : response
                                },
                                'success': function(data, textStatus, jqXHR) {
                                    //Если верунло 1 значит юзер залогинен
                                    if(jqXHR.responseText.code == null)
                                    {
                                        dialogStack.closeAll();
                                        window.location = "";
                                    }
                                },
                            })
                        } 
                    });
                }                
            });            
        });                     
    });
    
</script>

<div id="login_dialog">
    
    <!-- Login via social networks -->
    <div class="field">
    <?php 
//    $this->widget('ext.eauth.EAuthWidget', array('action' => 'guest/registerFacebookAjax'));
        echo Chtml::image(Yii::app()->request->baseUrl.'/images/facebook.png','',array('id'=>'fbimage'));
        echo Chtml::image(Yii::app()->request->baseUrl.'/images/linkedin.png','',array('id'=>'ldimage'));
    ?>
        <img src="http://graph.facebook.com/yaremchuk.ivan/picture"></img>
    </div>
    <?php 
        $form=new LoginForm;
        $formModel=new User();
        $formWidget = $this->beginWidget('CActiveForm', array(
            'id' => 'loginForm',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
                'validateOnChange'=>true,
                'afterValidate' => 'js: function(form, data, hasError) {
                    if (!hasError) {
                        $.ajax({
                          type: "POST",
                          dataType: "json",
                          url: "?r=guest/loginDirectAjax",
                          data: $("#loginForm").serialize(),
                          success: function(data, textStatus, jqXHR) {
                            //Если верунло 1 значит юзер залогинен
                            if(data.code == null)
                            {
                                dialogStack.closeAll();
                                window.location = "";
                            }
                          },

                        });
                        return false;
                    }
                }'

            ),
        ));
        echo CHtml::errorSummary($formModel);
    ?>

    <div class="field">
        <div>
        <?php echo CHtml::activeLabel($form,'email'); ?>
        <?php echo $formWidget->error($formModel,'email') ?>
        <div class="clear"></div>
        </div>
    <?php echo CHtml::activeTextField($form,'email') ?>
    </div>

    <div class="field">
        <div>
        <?php echo CHtml::activeLabel($form,'password'); ?>
        <?php echo $formWidget->error($formModel,'password') ?>
        <div class="clear"></div>
        </div>
    <?php echo CHtml::activePasswordField($form,'password') ?>
    </div>

    <div class="field">
    <?php echo CHtml::activeCheckBox($form,'rememberMe'); ?>
    <?php echo CHtml::activeLabel($form,'rememberMe'); ?>
    </div>
        
    <div class="button">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php $this->endWidget(); ?>

    <div class="button" id="button_register">
    <p>Register</p>
    </div>

</div>
