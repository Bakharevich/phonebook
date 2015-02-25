<?php
class Form_Login extends Phonebook_Form
{
	public function init()
	{
		$this->setMethod('post')
			 ->setAction('/auth/login/');

        // cross-site request forgery
        $csrf = $this->createElement('hash', 'csrf');
			 
		$username = $this->createElement('text', 'username')
                         ->setDecorators($this->elementDecorators)
						 ->setRequired(true)
						 ->addFilter('StringToLower')
                         ->addFilter('StripTags')
                         ->setAttrib('size', 30)
						 ->setLabel('Username');
					   
		$password = $this->createElement('password', 'password')
                         ->setDecorators($this->elementDecorators)
				         ->setRequired(true)
                         ->setAttrib('size', 30)
				         ->setLabel('Password');

        $submit = $this->createElement('submit', 'submit')
            ->setDecorators($this->buttonDecorators)
            ->setLabel('Sign In');
					   
		$this->addElement($csrf)
             ->addElement($username)
			 ->addElement($password)
			 ->addElement($submit);
	}
}