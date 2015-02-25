<?php
class AuthController extends Phonebook_Controller_Action
{
    public function init()
    {
        parent::init();
    }

    public function loginAction()
    {
        $config    = Zend_Registry::get('config');
        $dbAdapter = Zend_Registry::get('db');

        $form = new Form_Login();

        if ($this->getRequest()->isPost() && $form->isValid($this->getAllParams())) {
                 $values = $form->getValues();

				 $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

	             $authAdapter->setTableName('users');
                 $authAdapter->setIdentityColumn('email');
                 $authAdapter->setIdentity($values['username']);
	             $authAdapter->setCredentialColumn('password');
	             $authAdapter->setCredential(md5($config->auth->salt . $values['password']));

                 $select = $authAdapter->getDbSelect();
                 $select->where('is_active = 1');

	             $auth = Zend_Auth::getInstance();

	             try {
	             	$result = $auth->authenticate($authAdapter);
	             }
	             catch (Zend_Exception $e) {
	             	echo $e->getMessage();
	             	exit();
	             }

	             if ($result->isValid()) {
		             $data = $authAdapter->getResultRowObject(null, 'password');
		             $auth->getStorage()->write($data);

                     $this->redirect('/');
	             }
	             else {
		             $this->view->message = "Incorrect login or password";
	       		 }
		}

        $this->view->form = $form;
    }

    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();

    	$this->redirect('/');
    }

    public function noauthAction()
    {

    }
}

