<?php

namespace NBlog\ORM\Services;

use	Doctrine\ORM\NoResultException;


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
			//FIXME Eagerload Tags
			->getQuery()
				->setFirstResult($page - 1)
				->setMaxResults($this->getPostsPerPage())

			->getResult();

		return $result;
	}


	public function getPost($slug)
	{
		$q = $this->dbm->createQueryBuilder()
			->select('p')
			->from('\NBlog\Entities\Post', 'p')
			->where('p.slug = ?1')
			->setParameter(1, $slug)
			//FIXME Eagerload Tags
			->getQuery();

		try {
			$result = $q->getSingleResult();
		} catch(NoResultException $e) {
			$result = null;
		}

		return $result;
	}


	public function getPostsByTag($tag, $page = 1)
	{
		$result = $this->dbm->createQueryBuilder()
			->select('p')
			->from('\NBlog\Entities\Post', 'p')
			->leftJoin('p.tags', 't')
			->where("p.status = 'published'")
			->andWhere("t.name = ?1")
			->orderBy('p.created', 'DESC')
			->setParameter(1, $tag)
			->getQuery()
				->setFirstResult($page - 1)
				->setMaxResults($this->getPostsPerPage())

			->getResult();

		return $result;
	}

}
