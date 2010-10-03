<?php

namespace NBlog\ORM\Services;

use	Doctrine\ORM\NoResultException;


class UserService extends BaseService
{

	public function getbyEmail($email)
	{
		$q = $this->dbm->createQueryBuilder()
			->select('u')
			->from('\NBlog\Entities\User', 'u')
			->where('u.email = ?1')
			->setParameter(1, $email)
			->getQuery();

		try {
			$result = $q->getSingleResult();
		} catch(NoResultException $e) {
			$result = null;
		}

		return $result;
	}

}
