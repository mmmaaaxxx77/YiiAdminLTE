<?php

class RoleController extends Controller
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

			$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/page/user/role.css' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/role/model.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/role/role.js' );
			return true;
		}
		return false;
	}

	/*public function filters(){
		//return array('postOnly');
	}*/

	public function actionIndex()
	{
		$this->render('/user/role');
	}

	public function actionRoles($page, $size){
		if(Yii::app()->request->isAjaxRequest){
			$criteria=new CDbCriteria();
			$criteria->order = 'create_date DESC';
			$count=Role::model()->count($criteria);
			$pages=new CPagination($count);

			// results per page
			$pages->pageSize=$size;
			$pages->applyLimit($criteria);
			$pages->currentPage=$page;

			$accounts = Role::model()->findAll($criteria);
			$result = new CustomPaginationResult(true, $pages->pageCount, $accounts);
			$this->renderJSON($result);
		}
		throw new CHttpException(400, 'Bad Request');
	}

	public function actionAllRoles(){
		if(Yii::app()->request->isAjaxRequest){
			$roiles = Role::model()->findAll();
			$result = new CustomResult(true, $roiles);
			$this->renderJSON($result);
		}
		throw new CHttpException(400, 'Bad Request');
	}

}