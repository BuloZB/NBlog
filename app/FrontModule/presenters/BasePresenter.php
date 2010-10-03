<?php

namespace FrontModule;


class BasePresenter extends \BasePresenter
{

	protected function createTemplate()
	{
		$template = parent::createTemplate();
		$template->registerHelper('perex', 'NBlog\Templates\Helpers::perex');
		return $template;
	}

}
