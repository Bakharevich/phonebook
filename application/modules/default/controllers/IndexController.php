<?php
class IndexController extends Phonebook_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        Zend_Layout::getMvcInstance()->setLayout('main');

        $page     = (int) $this->getRequest()->getParam('page', 1);

        $Contacts = new Model_DbTable_Contacts();
        $form     = new Form_Search();
        $auth     = Zend_Auth::getInstance();
        $storage  = $auth->getInstance()->getStorage()->read();

        // if user not authorized, send him to auth page
        if (!$auth->hasIdentity()) {
            $this->redirect('/auth/');
        }

        // if search, get filtered from form
        if ($form->isValid($this->getAllParams())) {
            $search = $form->getValue('search');
        }
        else {
            $search = '';
        }

        // get data with pagination
        $paginator = Zend_Paginator::factory(
            $Contacts->getContactsByUserId(
                $storage->user_id,
                $search
            )
        );
        $paginator->setItemCountPerPage(10);
        $paginator->setCurrentPageNumber($page);

        $this->view->contacts = $paginator;
        $this->view->pages = $paginator->getPages();
        $this->view->searchForm = $form;
    }

    public function addAction()
    {
        $Contacts = new Model_DbTable_Contacts();
        $auth     = Zend_Auth::getInstance()->getStorage()->read();
        $form     = new Form_Contact();

        if ($this->getRequest()->isPost() && $form->isValid($this->getAllParams())) {
            $values = $form->getValues();

            $Contacts->insert(
                array(
                    'user_id'    => $auth->user_id,
                    'name'       => $values['name'],
                    'phone'      => $values['phone'],
                    'notes'      => $values['notes'],
                    'created_at' => date("Y-m-d H:i:s")
                )
            );

            $this->redirect('/');
        }

        $this->view->form = $form;
    }

    public function editAction()
    {
        $contactId = (int) $this->getRequest()->getParam('id');

        $Contacts = new Model_DbTable_Contacts();
        $auth     = Zend_Auth::getInstance()->getStorage()->read();
        $form     = new Form_Contact();

        $contactArr = $Contacts->getContactById($contactId);

        // check if that contact exists
        if (empty($contactArr->user_id)) {
            throw new Zend_Exception('Contact with that user_id does not exist');
        }

        // check if that contact belongs to user
        if ($contactArr->user_id != $auth->user_id) {
            throw new Zend_Exception('That contact does not belong to your user_id');
        }

        $form->populate($contactArr->toArray());

        if ($this->getRequest()->isPost() && $form->isValid($this->getAllParams())) {
            $values = $form->getValues();

            $Contacts->setContact($contactId,
                array(
                    'name'  => $values['name'],
                    'phone' => $values['phone'],
                    'notes' => $values['notes'],
                    'updated_at' => date("Y-m-d H:i:s")
                )
            );

            $this->redirect('/');
        }

        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $contactId = (int) $this->getRequest()->getParam('id');

        $Contacts = new Model_DbTable_Contacts();
        $auth     = Zend_Auth::getInstance()->getStorage()->read();

        $contactArr = $Contacts->getContactById($contactId);

        // check if that contact exists
        if (empty($contactArr->user_id)) {
            throw new Zend_Exception('Contact with that user_id does not exist');
        }

        // check if that contact belongs to user
        if ($contactArr->user_id != $auth->user_id) {
            throw new Zend_Exception('That contact does not belong to your user_id');
        }

        $Contacts->deleteContact($contactId);

        $this->redirect('/');
    }
}