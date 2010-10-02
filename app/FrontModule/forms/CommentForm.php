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

		$this->addProtection('Security token did not match. Possible CSRF attack.');

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
		$this->onInvalidSubmit[] = array($this, 'formInvalid');
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
			$this->response(false);
		}

		$this->presenter->flashMessage('Comment was successfuly saved', 'info');
		$this->response(true);
	}


	public function formInvalid(AppForm $form)
	{
		if ($this->getPresenter()->isAjax()) {
			$this->response(false);
		}
	}


	private function response($success = true)
	{
		if ($this->getPresenter()->isAjax()) {
			if ($success) {
				$commentService = new CommentService();
				$comments = $commentService->getBySlug($this->getPresenter()->getParam('slug'));
				$this->getPresenter()->template->comments = $comments;

				$this->getPresenter()->invalidateControl('comments');
				$this->getPresenter()->invalidateControl('commentsLink');
				$this->setValues(array(), true);
			}

			$this->getPresenter()->invalidateControl('commentForm');
		} else {
			$this->getPresenter()->redirect('this#comments');
		}
	}
}
