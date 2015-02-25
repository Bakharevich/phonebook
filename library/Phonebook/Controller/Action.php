<?php
class Phonebook_Controller_Action extends Zend_Controller_Action {
    public function init() {
        $auth = Zend_Auth::getInstance();
        $this->view->auth = $auth->getStorage()->read();
    }
}