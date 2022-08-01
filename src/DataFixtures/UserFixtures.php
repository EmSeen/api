<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createTestUser('admin@admin.ru', 'adminadmin', 'admin', ['ROLE_ADMIN']);
        $this->createTestUser('author@author.ru', 'authorauthor', 'author', ['ROLE_AUTHOR']);
        $this->createTestUser('user@user.ru', 'useruser', 'user', ['ROLE_USER']);

    }
}
