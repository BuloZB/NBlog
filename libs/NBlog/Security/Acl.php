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
		$this->addResource('Admin:Dashboard');
		$this->addResource('Admin:Post');
		$this->addResource('Admin:Comment');
		$this->addResource('Admin:Media');
		$this->addResource('Admin:Settings');

		// privileges
		$this->allow('admin', Permission::ALL, Permission::ALL);
	}

}
