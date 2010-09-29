<?php

namespace NBlog\Templates;


class Helpers
{

	/**
	 * Static class - cannot be instantiated
	 */
	final public function __construct()
	{
		throw new \LogicException("Cannot instantiate static class " . get_class($this));
	}


	public static function perex($subject)
	{
		$pos = strpos($subject, '<!--break-->');

		if ($pos !== false) {
			return substr($subject, 0, $pos);
		} else {
			return $subject;
		}
	}

}
