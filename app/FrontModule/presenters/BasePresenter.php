<?php

namespace FrontModule;


use	Nette\Templates\TemplateFilters,
	Texy;


class BasePresenter extends \BasePresenter
{

	protected function createTemplate()
	{
		$template = parent::createTemplate();

		$texy = new Texy();
		$texy->encoding = 'utf-8';
		$texy->allowedTags = Texy::NONE;
		$texy->allowedStyles = Texy::NONE;
		$texy->setOutputMode(Texy::HTML5);

		$template->registerHelper('texy', callback($texy, 'process'));
		$template->registerHelper('perex', 'NBlog\Templates\Helpers::perex');

		return $template;
	}

}
