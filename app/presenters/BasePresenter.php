<?php

use	Nette\Application\Presenter;


abstract class BasePresenter extends Presenter
{

	public function afterRender()
	{
		if ($this->isAjax() && $this->hasFlashSession()) {
			$this->invalidateControl('flashes');
		}
	}

}
