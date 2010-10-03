<?php

namespace NBlog\Security;

use	Nette\Object,
	Nette\Environment,
	Nette\Security\IAuthenticator,
	Nette\Security\Identity,
	Nette\Security\AuthenticationException,
	NBlog\ORM\Services\UserService;


class Authenticator extends Object implements IAuthenticator
{

	public function authenticate(array $credentials)
	{
		$userService = new UserService();

		$email = $credentials[self::USERNAME];
		$user  = $userService->getbyEmail($email);

		if (!$user) {
			throw new AuthenticationException('User with this email does not exist in our system', self::IDENTITY_NOT_FOUND);
		}

		$salt = Environment::getConfig('security')->salt;
		$password =  sha1($credentials[self::PASSWORD] . $salt);

		if ($user->getPassword() !== $password) {
			throw new AuthenticationException('Wrong password', self::INVALID_CREDENTIAL);
		}

		return new Identity(
			$user->getId(),
			$user->getRole(),
			array(
				'name'  => $user->getName(),
				'email' => $user->getEmail()
			)
		);
	}

}
