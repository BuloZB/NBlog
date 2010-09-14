<?php

use	Nette\Debug,
	Nette\Application\BadRequestException;


/**
 * Error presenter.
 */
class ErrorPresenter extends BasePresenter
{

	/**
	* @param  Exception
	* @return void
	*/
	public function renderDefault($exception)
	{
		if ($this->isAjax()) {
			$this->payload->error = TRUE;
			$this->terminate();

		} elseif ($exception instanceof BadRequestException) {
			$code = $exception->getCode();
			$this->setView(in_array($code, array(403, 404, 405, 410, 500)) ? $code : '4xx');

		} else {
			$this->setView('500');
			Debug::log($exception);
		}
	}

}
