<?php

declare(strict_types=1);

namespace Agenda\Auth\Domain\ReadModel;

use Agenda\Auth\Domain\Entity\Users;

interface GetUsers{
    public function byUsernameAndPassword(string $username,string $password): Users;

    public function getByNameAndEmail(string $name,string $email): Users;
}