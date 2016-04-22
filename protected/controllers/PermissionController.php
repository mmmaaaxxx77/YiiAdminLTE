<?php

class PermissionController extends Controller
{

	public function beforeAction($action) {
		if( parent::beforeAction($action) ) {
			/* @var $cs CClientScript */
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/select2/js/select2.full.js' );
			$cs->registerCssFile(Yii::app()->request->baseUrl . '/plugin/select2/css/select2.min.css' );
			$cs->registerCssFile(Yii::app()->request->baseUrl . '/plugin/adminLTE/plugins/datatables/css/dataTables.bootstrap.css' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/adminLTE/plugins/datatables/js/jquery.dataTables.min.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/adminLTE/plugins/datatables/js/dataTables.bootstrap.min.js' );

			$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/page/user/permission.css' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/permission/model.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/permission/permission.js' );
			return true;
		}
		return false;
	}

	/*public function filters(){
		//return array('postOnly');
	}*/

	public function actionIndex()
	{
		$this->render('/user/permission');
	}

	public function actionPermissions($page, $size){
		if(Yii::app()->request->isAjaxRequest){
			$criteria=new CDbCriteria();
			$criteria->order = 'codename ASC';
			$count=Permission::model()->count($criteria);
			$pages=new CPagination($count);

			// results per page
			$pages->pageSize=$size;
			$pages->applyLimit($criteria);
			$pages->currentPage=$page;

			$accounts = Permission::model()->findAll($criteria);
			$result = new CustomPaginationResult(true, $pages->pageCount, $accounts);
			$this->renderJSON($result);
		}
		throw new CHttpException(400, 'Bad Request');
	}

	public function actionAllPermissions(){
		if(Yii::app()->request->isAjaxRequest){
			$permissions = Permission::model()->findAll();
			$result = new CustomResult(true, $permissions);
			$this->renderJSON($result);
		}
		throw new CHttpException(400, 'Bad Request');
	}

}