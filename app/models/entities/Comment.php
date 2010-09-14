<?php

namespace NBlog\Entities;


/**
 * @Entity
 */
class Comment extends BaseEntity
{

	// <editor-fold defaultstate="collapsed" desc="author [string]">
	/** @column(type="string", length=100) */
	private $author;

	public function getAuthor()
	{
		return $this->author;
	}

	public function setAuthor($author)
	{
		$this->author = $author;
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
		$this->email = $text;
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

	// <editor-fold defaultstate="collapsed" desc="post 1:N">
    /** @ManyToOne(targetEntity="Post", inversedBy="comments") */
    private $post;

	public function getPost()
	{
		return $this->post;
	}

	public function setPost($post)
	{
		$this->post = $post;
	}
	// </editor-fold>

	/** MISC **/

	// <editor-fold defaultstate="collapsed" desc="__construct()">
	public function __construct()
	{

	}
	// </editor-fold>

}
