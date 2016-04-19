<?php

class AccountController extends Controller
{

	public function beforeAction($action) {
		if( parent::beforeAction($action) ) {
			/* @var $cs CClientScript */
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/account/account.js' );
			return true;
		}
		return false;
	}

	/*public function filters(){
		//return array('postOnly');
	}*/

	public function actionIndex()
	{
		$this->render('/user/account');
	}

}