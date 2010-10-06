<?php

namespace NBlog\ORM\Services;

use	NBlog\Entities\Comment,
	NBlog\ORM\Services\PostService;


class CommentService extends BaseService
{

	public function countAll()
	{
		$result = $this->dbm->createQueryBuilder()
			->select('count(c.id) i')
			->from('\NBlog\Entities\Comment', 'c')
			->getQuery()
			->getSingleResult();

		return $result['i'];
	}


	public function countNotApproved()
	{
		$result = $this->dbm->createQueryBuilder()
			->select('count(c.id) i')
			->from('\NBlog\Entities\Comment', 'c')
			->where("c.approved != true")
			->getQuery()
			->getSingleResult();

		return $result['i'];
	}


	public function getBySlug($slug)
	{
		$result = $this->dbm->createQueryBuilder()
			->select('c')
			->from('\NBlog\Entities\Comment', 'c')
			->leftJoin('c.post', 'p')
			->where("p.slug = ?1")
			->orderBy('c.created', 'ASC')
			->setParameter(1, $slug)
			->getQuery()
			->getResult();

		return $result;
	}


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
		$post->setCommentsCount($post->getCommentsCount() + 1);
		$comment->setPost($post);

		$this->dbm->persist($comment);
		$this->dbm->flush();
	}

}
