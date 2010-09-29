<?php

namespace NBlog\ORM\Services;

use Nette\Debug,
	Doctrine\ORM\NoResultException;


class PostService extends BaseService
{

	// <editor-fold defaultstate="collapsed" desc="postsPerPage">
	private $postsPerPage = 10;

	public function getPostsPerPage()
	{
		return $this->postsPerPage;
	}

	public function setPostsPerPage($postsPerPage)
	{
		$this->postsPerPage = $postsPerPage;
	}
	// </editor-fold>


	public function getPublishedPosts($page = 1)
	{

		$result = $this->dbm->createQueryBuilder()
			->select('p')
			->from('\NBlog\Entities\Post', 'p')
			->where("p.status = 'published'")
			->orderBy('p.created', 'DESC')
			->getQuery()
				->setFirstResult($page - 1)
				->setMaxResults($this->getPostsPerPage())

			->getResult();	//FIXME Eagerload Tags

		return $result;
	}


	public function getPost($slug)
	{
		$qb = $this->dbm->createQueryBuilder();

		$qb->select('p')
		   ->from('\NBlog\Entities\Post', 'p')
		   ->where('p.slug = ?1')
		   ->setParameter(1, $slug);

		try {
			$result = $qb->getQuery()->getSingleResult();
		} catch(NoResultException $e) {
			$result = null;
		}

		return $result;
	}

}
