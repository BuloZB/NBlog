<?php

namespace NBlog\ORM\Services;

use Nette\Debug,
	Doctrine\ORM\NoResultException;


class TagService extends BaseService
{

	public function getTag($tag)
	{
		$qb = $this->dbm->createQueryBuilder();

		$qb->select('t')
		   ->from('\NBlog\Entities\Tag', 't')
		   ->where('t.name = ?1')
		   ->setParameter(1, $tag);

		try {
			$result = $qb->getQuery()->getSingleResult();
		} catch(NoResultException $e) {
			$result = null;
		}

		return $result;
	}

}
