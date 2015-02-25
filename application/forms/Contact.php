<?php
class Form_Contact extends Phonebook_Form
{
    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data'  => 'HtmlTag')),
        array('Label'),
        array(array('row' => 'HtmlTag'), array('tag' => 'div', 'class' => 'form-group')),
    );

    public $buttonDecorators = array(
        'ViewHelper',

        array(array('row' => 'HtmlTag'), array('tag' => 'div')),
    );

	public function init()
	{
		$this->setMethod('post')
			 ->setAction($_SERVER['REQUEST_URI'])
             ->setDecorators(array('FormElements','Form'));

        // cross-site request forgery
        $csrf = $this->createElement('hash', 'csrf');
			 
		$name = $this->createElement('text', 'name')
                         ->setDecorators($this->elementDecorators)
						 ->setRequired(true)
                         ->addFilter('StripTags')
                         ->setAttrib('class', 'form-control')
                         ->setAttrib('size', 30)
						 ->setLabel('Name');
					   
		$phone = $this->createElement('text', 'phone')
                         ->setDecorators($this->elementDecorators)
				         ->setRequired(true)
                         ->addFilter('StripTags')
                         ->setAttrib('class', 'form-control')
                         ->setAttrib('size', 30)
				         ->setLabel('Phone number');

        $notes = $this->createElement('textarea', 'notes')
                      ->setDecorators($this->elementDecorators)
                      ->addFilter('StripTags')
                      ->setRequired(false)
                      ->setAttrib('rows', 8)
                      ->setAttrib('cols', 50)
                      ->setAttrib('class', 'form-control')
                      ->setLabel('Additional Notes');

        $submit = $this->createElement('button', 'submit')
                       ->setDecorators($this->buttonDecorators)
                       ->setAttrib('type', 'submit')
                       ->setAttrib('class', 'btn btn-default')
                       ->setLabel('Send');
					   
		$this->addElement($csrf)
             ->addElement($name)
			 ->addElement($phone)
			 ->addElement($notes)
			 ->addElement($submit);
	}
}