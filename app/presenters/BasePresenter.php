<?php

use	Nette\Application\Presenter;


abstract class BasePresenter extends Presenter
{

	protected function createTemplate()
	{
		$template = parent::createTemplate();
		$template->registerHelper('perex', 'NBlog\Templates\Helpers::perex');
		return $template;
	}


	public function afterRender()
	{
		if ($this->isAjax() && $this->hasFlashSession()) {
			$this->invalidateControl('flashes');
		}
	}

}
