<?php

namespace NBlog\ORM\Services;

use Nette\Debug,
	Doctrine\ORM\NoResultException;


class PostService extends BaseService
{

	public function getPosts($page = 1)
	{
		$qb = $this->dbm->createQueryBuilder();

		$qb->select('p')
		   ->from('\NBlog\Entities\Post', 'p')
		   ->orderBy('p.created', 'DESC');

		return $qb->getQuery()->getResult();
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
