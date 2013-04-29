
<script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui-1.10.2.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />

<script type="text/javascript">
    $(function(){
        $("#list").jqGrid({
            url:'?r=management/getTeam',
            datatype: 'xml',
            mtype: 'GET',
            colNames:['name','Date', 'Amount','Tax','Total','Notes'],
            colModel :[
                {name:'name', index:'name', width:180},
                {name:'invdate', index:'invdate', width:90},
                {name:'amount', index:'amount', width:80, align:'right'},
                {name:'tax', index:'tax', align:'right'},
                {name:'total', index:'total', align:'right'},
                {name:'note', index:'note', sortable:false}
            ],
            pager: '#pager',
            rowNum:10,
            rowList:[10,20,30],
            sortname: 'invid',
            sortorder: 'desc',
            viewrecords: true,
            gridview: true,
            caption: 'Eba zdes',
//            autowidth: true,
            cellLayout: 10,
            emptyrecords: 'You have no TEAMS !!!',
//            forceFit: true,
            shrinkToFit: false,
//            scrollOffset: 0
            height: 'auto'
        });
    });
</script>


<h2>My Teams:</h2>   


<span id="createTeamBtn">Создать новую</span>
<span id="findTeamBtn">Найти существующую</span>

<div id="createTeam" class="ui-corner-all hiding-form">
    <?php 
        $formModel=new Team();
        $formWidget = $this->beginWidget('CActiveForm', array(
            'id'    => 'formCreateTeam',
            'action' => array('/management/createTeam'),
            'htmlOptions' => array('enctype' => 'multipart/form-data'),            
            'enableClientValidation' => true,
//            'enableAjaxValidation' => true,            
            'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true)
        ));
        echo CHtml::errorSummary($formModel); 
    ?>

    <div class="field">
             
        <?php echo $formWidget->label($formModel,'name'); ?>
        <?php echo $formWidget->error($formModel,'name') ?>
        <div class="clear"></div>
      
        <?php echo $formWidget->textField($formModel,'name') ?>
        
    </div>    
    <div class="field">        
        <?php echo $formWidget->label($formModel,'info'); ?>   
        <?php echo $formWidget->error($formModel,'info') ?>
        <?php echo $formWidget->textArea($formModel,'info') ?>
    </div>
    
    <hr></hr>
    <p>Дополнительные параметры</p>
    
    <div class="field">        
        <?php echo $formWidget->label($formModel,'private'); ?>       
        <?php echo $formWidget->checkBox($formModel,'private') ?>
    </div>
    
    <div class="field">        
        <?php echo $formWidget->label($formModel,'logo'); ?>       
        <?php echo $formWidget->fileField($formModel,'logo') ?>
    </div>
           
    <div class="button">
    <?php echo CHtml::submitButton('Create'); ?>
    </div>  
    
    <?php $this->endWidget(); ?>
           
</div>


<div id="teamlist">
<?php
    if(empty($params['teams'])) echo "<p>Вы не состоите ни в одной команде. Для начала работы вам необходимо
        создать свою команду, либо присоединиться к уже существующим.</p>";
    else echo '
    <table id="list"><tr><td/></tr></table>
    <div id="pager"></div>';
?>
</div>

<script>
    
    var createTeamBtnState = 0;
//    
    $(function(){
        $( "#createTeam" ).hide();$( "#findTeam" ).hide();
//        $( "#createTeam" ).show('blind');
//       $( "#findTeam" ).show('blind');
        
        $("#createTeamBtn").click(function(){
            if (createTeamBtnState == 0)
            {
                $( "#createTeam" ).show( 'blind', { to: { width: 280, height: 185 } } , 250, callback );
                $("#createTeamBtn").addClass("color-red").removeClass("color-black");
                createTeamBtnState = 1;
            } else {
                $( "#createTeam" ).hide('blind',{},100);
                $("#createTeamBtn").addClass("color-black").removeClass("color-red");
                createTeamBtnState = 0;                
            }
        })
        
        $("#findTeamBtn").click(function(){
            $( "#findTeam" ).show( 'blind', { to: { width: 280, height: 185 } } , 300, callback );
        })
        
        
        function callback() {
//            setTimeout(function() {
//              $( "#createTeam:visible" ).removeAttr( "style" ).fadeOut();
//            }, 10000 );
        };
        
    })
    
    
    </script>