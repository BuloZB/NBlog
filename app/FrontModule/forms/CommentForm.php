<?php

namespace FrontModule\Forms;

use	Nette\Application\AppForm,
	Nette\Forms\Form,
	NBlog\ORM\Services\CommentService;


class CommentForm extends AppForm
{

	public function __construct($parent, $name)
	{
		parent::__construct($parent, $name);

		$this->addText('author', 'Author')
			->addRule(Form::FILLED, 'Enter name');

		$this->addText('authorEmail', 'Email')
			->addRule(Form::FILLED, 'Enter email')
			->addRule(Form::EMAIL, 'Not valid email');

		$this->addText('authorUrl', 'Website');

		$this->addTextArea('comment', 'Comment')
				->addRule(Form::FILLED, 'Comment can\'t be empty')
				->labelPrototype->class = 'visuallyHidden';

		$this->addSubmit('send', 'Send');
		$this->onSubmit[] = array($this, 'formSubmitted');
	}


	public function formSubmitted(AppForm $form)
	{
		$values = $form->getValues();
		$commentService = new CommentService();

		try {
			$commentService->insertNew(
				$this->getValues(),
				$this->getPresenter()->getParam('slug'),
				$this->getHttpRequest()
			);
		} catch (Exception $e) {
			$this->presenter->flashMessage('Saving of new comment failed', 'error');
			$this->presenter->redirect('this');
		}

		$this->presenter->flashMessage('Comment was successfuly sent', 'info');
		$this->presenter->redirect('this');
	}

}
