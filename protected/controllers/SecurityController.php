<?php

class SecurityController extends Controller
{

	/*public function filters(){
		//return array('postOnly');
	}*/

	public function actionLogin()
	{
		if(!Yii::app()->request->isPostRequest)
			throw new CHttpException(400, 'Bad Request');

		if (!empty($_POST['username']) && !empty($_POST['password']))
		{
			$identity = new UserIdentity($_POST['username'], $_POST['password']);
			if ($identity->authenticate())
			{
				Yii::app()->user->login($identity, 3600*24*7);
				//Yii::app()->user->setFlash('success', $this->setFlashMessage('Is Sign In NOW.'));
				$this->redirect(Yii::app()->createUrl('site/index'));
			}
			else
			{
				//Yii::app()->user->setFlash('error', $this->setFlashMessage("please Singn In. {$identity->errorMessage}"));
				//Yii::app()->user->logout();
			}

		}
		$this->renderPartial('login', array('message'=>'帳號密碼錯誤。'));

	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}