<?php

class ManagementController extends CController
{
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
            $this->redirect('?r=management/team');
	}

    public function actionGetTeam()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

//        $Teams = Team::model()->with(array(
//                'user' => array(
//                    'select' => false,
//                    'condition' => "\"user\".user_id = '".Yii::app()->user->id."'"
//                )
//            )
//        )->findAll();


//echo '<?xml version ="1.0" encoding="utf-8"?
//<rows>
//    <page>1</page>
//    <total>2</total>
//    <records>16</records>
//    <row id = "66">
//        <cell> cellcontent </cell>
//        <cell> <![CDATA[<font color=\'red\'>cell</font> content]]> </cell>
//        <cell></cell>
//        <cell></cell>
//        <cell>dwdwdwdwd</cell>
//           <cell>wdwdwdwdwd</cell>
//    </row>
//    <row id = "666">
//        <cell> cellcontent </cell>
//        <cell> <![CDATA[<font color=\'red\'>cell</font> content]]> </cell>
//        <cell></cell>
//        <cell></cell>
//        <cell>dwdwdwdw</cell>
//<cell>dwdwdwwdwdwdwwd</cell>
//    </row>
//</rows>';

//       echo json_encode(array('' $Teams[0]->attributes);

        $this->renderPartial('/partial/gridxml', array('rows' => $Teams));

    }

    public function actionTeam()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

//        $Teams = Team::model()->with(array(
//                'user' => array(
//                    'select' => false,
//                    'condition' => "\"user\".user_id = '".Yii::app()->user->id."'"
//                )
//            )
//        )->findAll();

        $this->render('index', array('partialView' => 'team', 'params' => array('teams' => null)));

	}
        
        public function actionCreateTeam()
        {
            $team = new Team();
            if(!isset($_REQUEST['Team']))
                Yii::app()->end(1);
            
            $team->team_id = Randomness::getGUID();
            $team->attributes = $_REQUEST['Team'];   
            $team->private = $_REQUEST['Team']['private'] ? true : false;

            $userTeam = new UserTeam();
            $userTeam->user_id = Yii::app()->user->id;
            $userTeam->team_id = $team->team_id;
            
            $file = CUploadedFile::getInstance($team,'logo');
            $team->picture = is_null($file) ? false : true;
            
            if (!is_null($file))
            {
                $file->saveAs(Yii::app()->basePath.'/../images/upload/'.$team->team_id);    
                chmod(Yii::app()->basePath.'/../images/upload/'.$team->team_id, 775);
            }

            $transaction = Yii::app()->db->beginTransaction();
            $team->save();
            $userTeam->save();
            $transaction->commit();
        }


}