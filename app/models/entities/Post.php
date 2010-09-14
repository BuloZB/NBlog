<?php

namespace NBlog\Entities;

use	\Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 */
class Post extends BaseEntity
{

	// <editor-fold defaultstate="collapsed" desc="headline [string]">
	/** @column(type="string", length=255) */
	private $headline;

	public function getHeadline()
	{
		return $this->headline;
	}

	public function setHeadline($headline)
	{
		$this->headline = $headline;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="slug [string]">
	/** @column(type="string", length=100, unique=true) */
	private $slug;

	public function getSlug()
	{
		return $this->slug;
	}

	public function setSlug($slug)
	{
		$this->slug = $slug;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="text [text]">
	/** @column(type="text") */
	private $text;

	public function getText()
	{
		return $this->text;
	}

	public function setText($text)
	{
		$this->text = $text;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="created [datetime]">
	/** @column(type="datetime") */
	private $created;

	public function getCreated()
	{
		return $this->created;
	}

	public function setCreated($created)
	{
		$this->created = $created;
	}
	// </editor-fold>

	/** RELATIONS **/

	// <editor-fold defaultstate="collapsed" desc="user 1:N">
    /** @ManyToOne(targetEntity="User", inversedBy="posts") */
    private $user;

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="comments N:1">
    /** @OneToMany(targetEntity="Comment", mappedBy="post") */
    private $comments;

	public function getComments()
	{
		return $this->comments;
	}

	public function setComments($comments)
	{
		$this->comments = $comments;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="tags N:M">
	/** @ManyToMany(targetEntity="Tag", inversedBy="posts") */
    private $tags;

	public function getTags()
	{
		return $this->tags;
	}

	public function setTags($tags)
	{
		$this->tags = $tags;
	}
	// </editor-fold>

	/** MISC **/

	// <editor-fold defaultstate="collapsed" desc="__construct()">
	public function __construct()
	{
		$this->tags = new ArrayCollection();
		$this->comments = new ArrayCollection();
	}
	// </editor-fold>

}
