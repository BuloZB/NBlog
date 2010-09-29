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

	// <editor-fold defaultstate="collapsed" desc="authorEmail [string]">
	/** @column(type="string", length=100) */
	private $authorEmail;

	public function getAuthorEmail()
	{
		return $this->authorEmail;
	}

	public function setAuthorEmail($authorEmail)
	{
		$this->authorEmail = $authorEmail;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="authorUrl [string]">
	/** @column(type="string", length=100, nullable=true) */
	private $authorUrl;

	public function getAuthorUrl()
	{
		return $this->authorUrl;
	}

	public function setAuthorUrl($authorUrl)
	{
		$this->authorUrl = $authorUrl;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="authorIp [integer]">
	/** @column(type="integer") */
	private $authorIp;

	public function getAuthorIp()
	{
		return $this->authorIp;
	}

	public function setAuthorIp($authorIp)
	{
		$this->authorIp = $authorIp;
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

	// <editor-fold defaultstate="collapsed" desc="approved [boolean]">
	/** @column(type="boolean") */
	private $approved;

	public function getApproved()
	{
		return $this->approved;
	}

	public function setApproved($approved)
	{
		$this->approved = $approved;
	}
	// </editor-fold>

	// <editor-fold defaultstate="collapsed" desc="agent [string]">
	/** @column(type="string", length=255) */
	private $agent;

	public function getAgent()
	{
		return $this->agent;
	}

	public function setAgent($agent)
	{
		$this->agent = $agent;
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

//user

	/** MISC **/

	// <editor-fold defaultstate="collapsed" desc="__construct()">
	public function __construct()
	{

	}
	// </editor-fold>

}
