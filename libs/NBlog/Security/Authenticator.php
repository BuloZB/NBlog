<?php

namespace NBlog\Security;

use Nette\Object;
use Nette\Environment;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\AuthenticationException;

class Authenticator extends Object implements IAuthenticator
{
    public function authenticate(array $credentials)
    {
        $login = $credentials[self::USERNAME];
        $row = \UserModel::getByEmail($login);

        if (!$row) {
            throw new AuthenticationException("Užívateľ s registračným emailom '$login' sa nenašiel!", self::IDENTITY_NOT_FOUND);
        }

        $config = Environment::getConfig('security');
        $password =  hash_hmac('sha256', $credentials[self::PASSWORD] . $row->salt , $config->hmacKey);

        if ($row->password !== $password) {
            throw new AuthenticationException("Zadali ste nesprávne heslo!", self::INVALID_CREDENTIAL);
        }

        return new Identity($row->name, $row->role);
    }
}