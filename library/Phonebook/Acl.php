<?php
class Phonebook_Acl extends Zend_Acl
{
    public function __construct()
    {
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('user'), 'guest');
        $this->addRole(new Zend_Acl_Role('admin'), array('user'));

        $this->add(new Zend_Acl_Resource('default-index'));
        $this->add(new Zend_Acl_Resource('default-auth'));
        $this->add(new Zend_Acl_Resource('default-error'));

        $this->allow('guest', 'default-index', array('index'));
        $this->allow('guest', 'default-auth', array('login', 'logout', 'noauth'));
        $this->allow('guest', 'default-error', array('error'));

        $this->allow('user', 'default-index', array('add', 'edit', 'delete'));
    }
}