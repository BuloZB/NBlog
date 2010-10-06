<?php

namespace AdminModule;

use	Nette\Web\User,
	NBlog\ORM\Services\CommentService,
	NBlog\ORM\Services\PostService,
	AdminModule\Forms\QuickPostForm;


final class DashboardPresenter extends BasePresenter
{

	public function startup()
	{
		parent::startup();
		$user = $this->getUser();

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


	public function renderDefault()
	{
		$postService	= new PostService();
		$commentService	= new CommentService();

		$statistics['posts']['numAll']				= $postService->countAll();
		$statistics['posts']['numDrafts']			= $postService->countDrafts();
		$statistics['comments']['numAll']			= $commentService->countAll();
		$statistics['comments']['numNotApproved']	= $commentService->countNotApproved();

		$this->template->statistics		= $statistics;
		$this->template->recentComments	= $recentComments;
	}


	public function actionLogout()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have logged out of administration.', 'info');
		$this->redirect('Auth:login');
	}


	protected function createComponentQuickPostForm($name)
	{
		$form = new QuickPostForm($this, $name);
	}

}
