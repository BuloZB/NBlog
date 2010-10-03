<?php

namespace AdminModule;

use	Nette\Environment,
	Nette\Web\User;


final class DashboardPresenter extends BasePresenter
{

	public function startup()
	{
		parent::startup();
		$user = Environment::getUser();

		if (!$user->isLoggedIn()) {
			if ($user->getLogoutReason() === User::INACTIVITY) {
				$this->flashMessage('Your admin session timed out! System log you out for security reasons.', 'error');
			}

			$backlink = $this->getApplication()->storeRequest();
			$this->redirect('Auth:login', array('backlink'=>$backlink));
		} else {
			if (!$user->isAllowed($this->getName(), $this->getAction())) {
				$this->flashMessage('Access diened! You don\'t have permisions to enter.', 'error');
				$this->redirect('Auth:login');
			}
		}
	}


	public function actionLogout()
	{
		Environment::getUser()->signOut();
		$this->flashMessage('You have logged out of administration.', 'info');
		$this->redirect('Auth:login');
	}

}
