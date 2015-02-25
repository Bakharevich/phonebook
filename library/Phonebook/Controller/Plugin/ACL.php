<?php
class Phonebook_Controller_Plugin_ACL extends Zend_Controller_Plugin_Abstract
{
    protected $_defaultRole = 'guest';

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $auth = Zend_Auth::getInstance();
        $acl = new Phonebook_Acl();
        $mySession = new Zend_Session_Namespace('mysession');
        $module = $request->getModuleName();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $resource = $module . "-" . $controller;

        if($auth->hasIdentity()) {
            $user = $auth->getIdentity();
            if ($acl->has($resource)) {
                if (!$acl->isAllowed($user->role, $resource, $action)) {
                    return Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')->setGotoUrl('/auth/noauth/');
                }
            }
            else {
                throw new Zend_Acl_Exception('There is no such resource ' . $resource);
            }
        }
        else {
            if(!$acl->isAllowed($this->_defaultRole, $resource, $action)) {
                $mySession->destinationUrl = $request->getPathInfo();

                return Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')->setGotoUrl('/auth/login/');
            }
            else {
                //$this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                //throw new Exception('К сожалению, запрошенной страницы не существует');
            }
        }
    }
}