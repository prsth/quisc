    <?php
    
        $this->widget('application.components.widget.Menu',array(
            'items'=>array(
                array('label'=>'Profile', 'url'=>array('/management/profile')),
                array('label'=>'Team', 'url'=>array('/management/team')),
                array('label'=>'Project', 'url'=>array('/management/project')),                            
            ),
            'view'=>'submenu'
          ));
    
    ?>
            
<div class="workspace">

    <?php $this->renderPartial($partialView, array('params' => $params)); ?>
    
</div>

