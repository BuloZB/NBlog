<?php

namespace NBlog\Security;

use Nette\Security\Permission;

class Acl extends Permission
{
    public function __construct()
    {
        // role
        $this->addRole('guest');
        $this->addRole('registered', 'guest');
        $this->addRole('editor', 'registered');
        $this->addRole('admin', 'editor');

        // zdroje
        $this->addResource('AdminModule\DefaultPresenter');
        $this->addResource('AdminModule\PagePresenter');
        $this->addResource('AdminModule\UserPresenter');

        // opravnenia
        $this->allow('registered', 'AdminModule\DefaultPresenter', Permission::ALL);
        $this->allow('editor', 'AdminModule\PagePresenter', Permission::ALL);
        $this->allow('admin', Permission::ALL, Permission::ALL);
    }
}