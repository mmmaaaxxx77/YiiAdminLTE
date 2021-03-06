<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	public function authenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;*/

		$user = Account::model()->findByAttributes(array('name' => $this->username));
		if ($user === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if ($user->password != $this->password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id = $user->id;
			$this->setState('email', $user->email);
			$this->errorCode = self::ERROR_NONE;
		}
		//$user->last_login = new CDbExpression('NOW()');
		Account::model()->updateByPk($user->id, array('last_login'=>new CDbExpression('NOW()')));

		return !$this->errorCode;
	}
}