<?php

namespace AdminModule\Forms;

use	Nette\Application\AppForm,
	Nette\Forms\Form;


class QuickPostForm extends AppForm
{

	public function __construct($parent, $name)
	{
		parent::__construct($parent, $name);
		$this->addProtection('Security token did not match. Possible CSRF attack.');

		$this->addText('headline', 'Title:')
			->addRule(Form::FILLED, 'Please fill Title');

		$this->addTextArea('text', 'Text:')
			->addRule(Form::FILLED, 'Text is empty');

		$this->addText('tags', 'Tags:');

		$this->addSubmit('draft', 'saved draft')
			->onClick[] = array($this, 'submittedSaveDraft');

		$this->addSubmit('publish', 'publish')
			->onClick[] = array($this, 'submittedPublish');
	}


	public function submittedSaveDraft()
	{

	}


	public function submittedPublish()
	{

	}

}
