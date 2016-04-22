<?php

class AccountController extends Controller
{

	public function beforeAction($action) {
		if( parent::beforeAction($action) ) {
			$cs = Yii::app()->clientScript;
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/select2/js/select2.full.js' );
			$cs->registerCssFile(Yii::app()->request->baseUrl . '/plugin/select2/css/select2.min.css' );
			$cs->registerCssFile(Yii::app()->request->baseUrl . '/plugin/adminLTE/plugins/datatables/css/dataTables.bootstrap.css' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/adminLTE/plugins/datatables/js/jquery.dataTables.min.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/adminLTE/plugins/datatables/js/dataTables.bootstrap.min.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/md5.js' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/plugin/moment.js' );

			$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/page/user/account.css' );
			$cs->registerScriptFile(Yii::app()->request->baseUrl . '/jacascript/page/account/model.js' );
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

	public function actionUsers($page, $size){
		if(Yii::app()->request->isAjaxRequest){
			$criteria=new CDbCriteria();
			$criteria->order = 'last_update DESC';
			$count=Account::model()->count($criteria);
			$pages=new CPagination($count);

			// results per page
			$pages->pageSize=$size;
			$pages->applyLimit($criteria);
			$pages->currentPage=$page;

			$accounts = Account::model()->with('roles', 'permissions', 'image')->findAll($criteria);
			$result = new CustomPaginationResult(true, $pages->pageCount, AccountViewModel::toViewModels($accounts));
			$this->renderJSON($result);
		}
		throw new CHttpException(400, 'Bad Request');
	}

	public function actionNewUser(){
		if(Yii::app()->request->isAjaxRequest) {
			/*$post = Yii::app()->request->rawBody;
			$data = CJSON::decode($post, true);

			$name = $data['name'];
			$email = $data['email'];
			$password = $data['password'];*/
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];


		}else{
			throw new CHttpException(400, 'Bad Request');
		}

		$account = new Account();
		$account->name = $name;
		$account->email = $email;
		$account->password = $password;

		$account->save();

		if(!empty($_FILES['file'])) {
			$image = new Image();
			$image->setData($_FILES['file'], $account->id);
			$image->save();
		}

		$this->renderJSON(new CustomResult(true, null));

	}

	public function actionDeleteUser(){
		$account = Account::model();
		$account->deleteByPk($_POST['id']);

		$this->renderJSON(new CustomResult(true, $account));
	}

	public function actionUpdateUser(){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];

		// file
		if(!empty($_FILES['file'])) {
			// delete file
			$img = Image::model()->findByPk(array("id"=>$id));
			if($img != null){
				unlink(YiiBase::getPathOfAlias('webroot').$img->path);
				// delete file db
				Image::model()->deleteByPk($id);
			}
			// save
			$image = new Image();
			$image->setData($_FILES['file'], $id);
			$image->save();
		}

		//
		Account::model()->updateByPk($id,
			array('last_update'=>new CDbExpression('NOW()'),
				'name'=>$name,
				'email'=>$email,
			));
		// roles
		if(!empty($_POST['roles'])) {
			$criteria = new CDbCriteria();
			$criteria->compare('account_id', $id);
			Account_Role::model()->deleteAll($criteria);
			$roles = $_POST['roles'];
			foreach ($roles as $key => $value) {
				$a_r = new Account_Role;
				$a_r->account_id = $id;
				$a_r->role_id = $value;
				$a_r->save();
			}
		}else{
			$criteria = new CDbCriteria();
			$criteria->compare('account_id', $id);
			Account_Role::model()->deleteAll($criteria);
		}

		// permissions
		if(!empty($_POST['permissions'])) {
			$criteria2 = new CDbCriteria();
			$criteria2->compare('account_id', $id);
			Account_Permission::model()->deleteAll($criteria2);
			$permissions = $_POST['permissions'];
			foreach ($permissions as $key=>$value){
                $a_r = new Account_Permission;
                $a_r->account_id = $id;
                $a_r->permission_id = $value;
                $a_r->save();
            }
		}else{
			$criteria2 = new CDbCriteria();
			$criteria2->compare('account_id', $id);
			Account_Permission::model()->deleteAll($criteria2);
		}


		$this->renderJSON(new CustomResult(true, null));
	}

	public function actionUser($id){
		if(Yii::app()->request->isAjaxRequest){
			$account = Account::model()->with('image', 'roles', 'permissions')->findByPk(array("id"=>$id));
			$result = new CustomResult(true, AccountViewModel::toViewModel($account));
			$this->renderJSON($result);
		}
		throw new CHttpException(400, 'Bad Request');
	}
}