<?php

namespace FrontModule;

use \NBlog\ORM\Services\PostService,
	\NBlog\ORM\Services\TagService;


class DefaultPresenter extends \BasePresenter
{

	public function renderDefault()
	{
		$postService = new PostService();
		$postService->setPostsPerPage = 10;
		$page = 1;
		$this->template->posts = $postService->getPublishedPosts($page);
	}


	public function renderPost($slug)
	{
		$postService = new PostService();
		$post = $postService->getPost($slug);

		if (!$post) {
			$this->redirect('default');
		}

		$this->template->post = $post;
		$this->template->comments = $post->getComments();
	}


	public function renderTag($tag)
	{
		$postService = new TagService();
		$tagEntity = $postService->getTag($tag);

		if (!$tagEntity) {
			$this->redirect('default');
		}

		$this->template->tagName = $tagEntity->getName();
		$this->template->posts = $tagEntity->getPosts();
	}

}
