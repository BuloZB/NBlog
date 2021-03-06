<?php

namespace NBlog\Entities;

use Nette\Object,
	Nette\Environment,
	Nette\Caching\Cache;


/**
 * @MappedSuperclass
 * --HasLifecycleCallbacks
 *
 * @property-read int $id
 */
abstract class BaseEntity extends Object
{

	/**
	 * @id @column(type="integer")
	 * @generatedvalue(strategy="IDENTITY")
	 * @var int
	 */
	protected $id;

	/** @var \Doctrine\ORM\EntityRepository */
	private $repository;


	public function persist()
	{
		Environment::getDatabaseManager()->persist($this);
	}


	public function remove()
	{
		Environment::getDatabaseManager()->remove($this);
	}


	public function setValues(array $data)
	{
		foreach ($data as $key => $value) {
			$this->__set($key, $value);
		}
	}


	/** @return \Doctrine\ORM\EntityRepository */
	public function getRepository()
	{
		if ($this->repository === NULL) {
			$this->repository = Environment::getEntityManager()->getRepository(\get_class($this));
		}
		return $this->repository;
	}


	public function free()
	{
		$this->repository = NULL;
	}

	public function __sleep()
	{
		$this->free();
	}


	public function getId()
	{
		return $this->id;
	}

//	public function getCacheTags()
//	{
//		$tags = array();
//		if ($this->id !== NULL) {
//			$tags[] = get_class($this) . '#' . $this->id;
//		}
//		return $tags;
//	}
//
//
//	/**
//	* @PostPersist
//	* @PostUpdate
//	* @PostRemove
//	*/
//	public function cleanCache()
//	{
//		Environment::getCache()->clean(array(
//			Cache::TAGS => array_merge(array(get_class($this)), $this->getCacheTags())
//		));
//	}

}
