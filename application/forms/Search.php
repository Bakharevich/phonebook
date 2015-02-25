<?php
class Form_Search extends Phonebook_Form
{
    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data'  => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
        array('Label', array('tag' => 'td')),

    );

    public $buttonDecorators = array(
        'ViewHelper',
        array(array('data' => 'HtmlTag'),  array('tag' => 'td', 'class' => 'element')),
        array(array('label' => 'HtmlTag'), array('tag' => 'td',  'placement' => 'prepend')),
    );

	public function init()
	{
		$this->setMethod('get')
			 ->setAction('/');

		$username = $this->createElement('text', 'search')
                         ->setDecorators($this->elementDecorators)
						 ->setRequired(false)
                         ->addFilter('StripTags')
                         ->setAttrib('size', 30)
						 ->setLabel('Search');

        $submit = $this->createElement('submit', 'submit')
                       ->setDecorators($this->buttonDecorators)
                       ->setLabel('Search');
					   
		$this->addElement($username)
			 ->addElement($submit);
	}
}