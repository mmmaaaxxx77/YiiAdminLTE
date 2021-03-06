<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function beforeAction($action) {
		if( parent::beforeAction($action) ) {
			/* @var $cs CClientScript */
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/jQuery/jQuery-2.1.4.min.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/bootstrap/js/bootstrap.min.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/app.min.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/knockout/knockout-3.3.0.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/knockout/knockout.mapping.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/default/defaultFunctions.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/default/defaultModel.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/default/default.js' );
			return true;
		}
		return false;
	}

	protected function renderJSON($data)
	{
		header('Content-type: application/json');
		//echo CJSON::encode($data);
		echo json_encode($data);

		foreach (Yii::app()->log->routes as $route) {
			if($route instanceof CWebLogRoute) {
				$route->enabled = false; // disable any weblogroutes
			}
		}
		Yii::app()->end();
	}
}