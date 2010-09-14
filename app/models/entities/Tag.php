<?php

namespace NBlog\Entities;

use	\Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 */
class Tag extends BaseEntity
{

	// <editor-fold defaultstate="collapsed" desc="name [string]">
	/** @column(type="string", length=100) */
	private $name;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
	// </editor-fold>

	/** RELATIONS **/

	// <editor-fold defaultstate="collapsed" desc="posts M:N">
	/** @ManyToMany(targetEntity="Post", mappedBy="tags") */
    private $posts;

	public function getPosts()
	{
		return $this->posts;
	}

	public function setPosts($posts)
	{
		$this->posts = $posts;
	}
	// </editor-fold>

	/** MISC **/

	// <editor-fold defaultstate="collapsed" desc="__construct()">
	public function __construct()
	{
		$this->posts = new ArrayCollection();
	}
	// </editor-fold>

}
