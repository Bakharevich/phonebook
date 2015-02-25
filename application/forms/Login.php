<?php
class Form_Login extends Phonebook_Form
{
    public $bootstrapDecorators = array(
        'ViewHelper',
        'Errors',

        array('Label', array('class' => 'sr-only')),
    );

    public $bootstrapButtonDecorators = array(
        'ViewHelper',
        'Errors',
        array(array('data'  => 'HtmlTag')),
        array('Label', array('class' => 'sr-only')),
        array(array('row' => 'HtmlTag')),
    );

	public function init()
	{
		$this->setMethod('post')
			 ->setAction('/auth/login/')
             ->setAttrib('class', 'form-signin')
             ->setDecorators(array('FormElements','Form'));

        // cross-site request forgery
        $csrf = $this->createElement('hash', 'csrf')->removeDecorator('label')->removeDecorator('HtmlTag');
			 
		$username = $this->createElement('text', 'username')
                         ->setDecorators($this->bootstrapDecorators)
						 ->setRequired(true)
						 ->addFilter('StringToLower')
                         ->addFilter('StripTags')
                         ->setAttrib('class', 'form-control')
                         ->setAttrib('id', 'inputUsername')
                         ->setAttrib('placeholder', 'Username')
                         ->setAttrib('autofocus', 'autofocus')
						 ->setLabel('Username');
					   
		$password = $this->createElement('password', 'password')
                         ->setDecorators($this->bootstrapDecorators)
				         ->setRequired(true)
                         ->setAttrib('class', 'form-control')
                         ->setAttrib('placeholder', 'Password')
				         ->setLabel('Password');

        $submit = $this->createElement('button', 'submit')
                       ->setDecorators($this->bootstrapButtonDecorators)
                       ->setAttrib('class', 'btn btn-lg btn-primary btn-block')
                       ->setAttrib('type', 'submit')
                       ->setLabel('Sign In');

        $note = new Phonebook_Form_Element_Note(
            'note',
            array('value' => '<h2 class="form-signin-heading">Phonebook</h2>')
        );
        $note->removeDecorator('label')->removeDecorator('HtmlTag');
        $this->addElement($note);
					   
		$this->addElement($csrf)
             ->addElement($username)
			 ->addElement($password)
			 ->addElement($submit);
	}
}