
<div id="login_dialog">

    <!-- Login via social networks -->
<!--    <div class="field">-->
<!--        --><?php
//        //    $this->widget('ext.eauth.EAuthWidget', array('action' => 'guest/registerFacebookAjax'));
//        echo Chtml::image(Yii::app()->request->baseUrl.'/images/facebook.png','',array('id'=>'fbimage'));
//        echo Chtml::image(Yii::app()->request->baseUrl.'/images/linkedin.png','',array('id'=>'ldimage'));
//        ?>
<!--        <img src="http://graph.facebook.com/yaremchuk.ivan/picture"></img>-->
<!--    </div>-->
    <?php
        $form=new LoginForm;
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
                          success: dialogStack.successAjax
                        });
                        return false;
                    }
                }'

            ),
        ));

        echo CHtml::errorSummary($form);
    ?>

    <div class="field">
        <div>
            <?php echo CHtml::activeLabel($form,'email'); ?>
            <?php echo $formWidget->error($form,'email') ?>
            <div class="clear"></div>
        </div>
        <?php echo CHtml::activeTextField($form,'email') ?>
    </div>

    <div class="field">
        <div>
            <?php echo CHtml::activeLabel($form,'password'); ?>
            <?php echo $formWidget->error($form,'password') ?>
            <div class="clear"></div>
        </div>
        <?php echo CHtml::activePasswordField($form,'password') ?>
    </div>

    <div class="field">
        <div id="captcha">
            <?$this->widget('CCaptcha')?>
            <?=CHtml::activeTextField($form, 'verifyCode')?>
            <?php echo $formWidget->error($form,'verifyCode') ?>
            <div class="clear"></div>
        </div>
    </div>

    <div class="ioba">
        <? echo ECHtml::bgLinkButton('Войти', 'ui-icon-formbutton', 'ui-form-buttontext')?>
    </div>

    <?php $this->endWidget(); ?>

    <div class="button" id="button_register">
        <p>Register</p>
    </div>

</div>
