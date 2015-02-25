<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initSession(){
        Zend_Session::start();
    }

    protected function _initPlugins()
    {
        $objFront = Zend_Controller_Front::getInstance();
        $objFront->registerPlugin(new Phonebook_Controller_Plugin_ACL(), 1);

        return $objFront;
    }

    protected function _initAutoload()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(
            array('namespace' => '',
                  'basePath'  => APPLICATION_PATH)
        );

        return $moduleLoader;
    }

    protected function _initLayoutHelper()
    {
        $layoutLoader = new Phonebook_Controller_Action_Helper_Layoutloader();
        Zend_Controller_Action_HelperBroker::addHelper($layoutLoader);
    }

    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions());
        Zend_Registry::set('config', $config);

        return $config;
    }

    protected function _initDb(){
        $db_config = Zend_Registry::get('config');

        $db = Zend_Db::factory($db_config->db->adapter, $db_config->db->params);
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Registry::set('db', $db);
    }
}