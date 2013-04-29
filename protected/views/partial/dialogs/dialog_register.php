<div id="dialog_register">
   <?php
        $formModel=new User();
        $formWidget = $this->beginWidget('CActiveForm', array(
            'id' => 'formRegister',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true,'validationUrl'=>array('/guest/validateRegistrationForm'),

            'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                        $.ajax({
                          type: "POST",
                          url: "?r=guest/registerAjax",
                          data: $("#formRegister").serialize(),
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
                        }}'

            ),

        ));
        echo CHtml::errorSummary($formModel);
    ?>

    <div class="field">
        <div>
        <?php echo $formWidget->label($formModel,'email'); ?>
        <?php echo $formWidget->error($formModel,'email') ?>
        <div class="clear"></div>
        </div>
        <?php echo $formWidget->textField($formModel,'email') ?>

    </div>

    <div class="field">
        <div>
        <?php echo $formWidget->label($formModel,'password'); ?>
        <?php echo $formWidget->error($formModel,'password') ?>
        <div class="clear"></div>
        </div>
        <?php echo $formWidget->passwordField($formModel,'password') ?>
    </div>

    <div class="field">
        <div>
        <?php echo $formWidget->label($formModel,'firstname'); ?>
        <?php echo $formWidget->error($formModel,'firstname') ?>
        <div class="clear"></div>
        </div>
        <?php echo $formWidget->textField($formModel,'firstname'); ?>
    </div>
    
    <div class="field">
        <div>
        <?php echo $formWidget->label($formModel,'lastname'); ?>
        <?php echo $formWidget->error($formModel,'lastname') ?>
        <div class="clear"></div>
        </div>
        <?php echo $formWidget->textField($formModel,'lastname'); ?>
    </div>
        
    <div class="button">
<?php echo CHtml::submitButton('Register') ?>


    </div>  
    
    <?php $this->endWidget(); ?>
    
    <div class="button" id="login_button2">
        <p>Login</p>
    </div>

</div>