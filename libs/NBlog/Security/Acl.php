<?php

namespace NBlog\Security;

use Nette\Security\Permission;


class Acl extends Permission
{
	public function __construct()
	{
		// roles
		$this->addRole('guest');
		$this->addRole('admin');

		// resources
		$this->addResource('AdminModule\DashboardPresenter');
		$this->addResource('AdminModule\PostPresenter');
		$this->addResource('AdminModule\CommentPresenter');
		$this->addResource('AdminModule\MediaPresenter');
		$this->addResource('AdminModule\SettingsPresenter');

		// privileges
		$this->allow('admin', Permission::ALL, Permission::ALL);
	}

}
