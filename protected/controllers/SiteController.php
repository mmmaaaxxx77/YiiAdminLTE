<?php

class SiteController extends Controller
{

	public function beforeAction($action) {
		if( parent::beforeAction($action) ) {
			/* @var $cs CClientScript */
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/dashboard/dashboard.js' );
			return true;
		}
		return false;
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest)
			$this->renderPartial('/security/login', array('message'=>''));
		else
			$this->render('/dashboard/index');
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}