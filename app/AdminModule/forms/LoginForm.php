<?php

namespace AdminModule\Forms;

use	Nette\Application\AppForm,
	Nette\Forms\Form,
	Nette\Environment,
	Nette\Security\AuthenticationException;


class LoginForm extends AppForm
{

	public function __construct($parent, $name)
	{
		parent::__construct($parent, $name);

		$this->addProtection('Security token did not match. Possible CSRF attack.');

		$this->addText('login', 'Email:')
			->addRule(Form::FILLED, 'Please enter your email')
			->addRule(Form::EMAIL, 'Email address is not valid');

		$this->addPassword('password', 'Password:')
			->addRule(Form::FILLED, 'Please enter password');

		$this->addSubmit('send', 'Log in!');
		$this->onSubmit[] = array($this, 'formSubmitted');
	}


	public function formSubmitted($form)
	{
		try {

			$user = Environment::getUser();
			$user->login($form['login']->value, $form['password']->value);

			$this->getPresenter()
				->getApplication()
				->restoreRequest($this->getPresenter()->backlink);

			$this->getPresenter()->redirect('Dashboard:default');

		} catch (AuthenticationException $e) {

			$form->addError($e->getMessage());

		}
	}

}
