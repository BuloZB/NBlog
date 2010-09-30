<?php

namespace NBlog\ORM\Services;

use	NBlog\Entities\Comment,
	NBlog\ORM\Services\PostService;


class CommentService extends BaseService
{

	public function insertNew($data, $slug, $request)
	{
		$comment = new Comment();

		$comment->setAuthor($data['author']);
		$comment->setAuthorEmail($data['authorEmail']);
		$comment->setAuthorUrl($data['authorUrl']);
		$comment->setAuthorIp($request->getRemoteAddress());
		$comment->setText($data['comment']);

		$requestHeaders = $request->getHeaders();
		$comment->setAgent($requestHeaders['user-agent']);
		$comment->setApproved(true);
		$comment->setCreated(new \DateTime());

		$postService = new PostService();
		$post = $postService->getPost($slug);
		$post->setCommentsCount($post->setCommentsCount() + 1);
		$comment->setPost($post);

		$this->dbm->persist($comment);
		$this->dbm->flush();
	}

}
