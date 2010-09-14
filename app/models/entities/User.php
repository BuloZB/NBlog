<?php

namespace NBlog\Entities;

use	\Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 * @Table(
 *     name="User",
 *     indexes={
 *         @index(name="idx_email", columns={"email"})
 *     }
 * )
 */
class User extends BaseEntity
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

	// <editor-fold defaultstate="collapsed" desc="email [string]">
	/**
	 * @column(type="string", length=100, unique=true)
	 */
	private $email;

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="password [string]">
	/** @column(type="string", length=40) */
	private $password;

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="role [string]">
	/** @column(type="string", length=100) */
	private $role;

	public function getRole()
	{
		return $this->role;
	}

	public function setRole($role)
	{
		$this->role = $role;
	}
	// </editor-fold>

	/** RELATIONS **/

	// <editor-fold defaultstate="collapsed" desc="posts N:1">
    /** @OneToMany(targetEntity="Post", mappedBy="user") */
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
