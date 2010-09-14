<?php

namespace NBlog\ORM\Services;

use Nette\Environment;


class BaseService
{

	/** @var \NBlog\ORM\DatabaseManager */
	protected $dbm;


	public function __construct()
	{
		$this->dbm = Environment::getDatabaseManager();
	}

}
