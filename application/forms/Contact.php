<?php
class Form_Contact extends Phonebook_Form
{
	public function init()
	{
		$this->setMethod('post')
			 ->setAction($_SERVER['REQUEST_URI']);

        // cross-site request forgery
        $csrf = $this->createElement('hash', 'csrf');
			 
		$name = $this->createElement('text', 'name')
                         ->setDecorators($this->elementDecorators)
						 ->setRequired(true)
                         ->addFilter('StripTags')
                         ->setAttrib('size', 30)
						 ->setLabel('Name');
					   
		$phone = $this->createElement('text', 'phone')
                         ->setDecorators($this->elementDecorators)
				         ->setRequired(true)
                         ->addFilter('StripTags')
                         ->setAttrib('size', 30)
				         ->setLabel('Phone number');

        $notes = $this->createElement('textarea', 'notes')
                      ->setDecorators($this->elementDecorators)
                      ->addFilter('StripTags')
                      ->setRequired(false)
                      ->setAttrib('rows', 8)
                      ->setAttrib('cols', 50)
                      ->setLabel('Additional Notes');

        $submit = $this->createElement('submit', 'submit')
                       ->setDecorators($this->buttonDecorators)
                       ->setLabel('Send');
					   
		$this->addElement($csrf)
             ->addElement($name)
			 ->addElement($phone)
			 ->addElement($notes)
			 ->addElement($submit);
	}
}