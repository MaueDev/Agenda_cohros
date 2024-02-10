<?php

declare(strict_types=1);

namespace Agenda\Core\Domain\Seeder;

use Agenda\Auth\Domain\Entity\Users;
use Agenda\Contacts\Domain\Entity\Contacts;
use Agenda\Contacts\Domain\Entity\Phone;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PopulateInitialSeeder implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $nomes = ['João', 'Maria', 'José', 'Ana', 'Pedro', 'Mariana', 'Paulo', 'Carla', 'Antônio', 'Fernanda'];
        $user  = new Users();
        $user->setName('Mauricio');
        $user->setUsername('maue');
        $user->setPassword('test');
        $user->setEmail('Mauricio@gmail.com');
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $contact = new Contacts();
            $contact->setName($nomes[rand(0, count($nomes) - 1)]);
            $contact->setEmail('email' . ($i + 1) . '@example.com');
            $contact->setAddress('Endereço do Contato ' . ($i + 1));
            $contact->setUser($user);

                $numPhones = rand(3, 8);
            for ($j = 0; $j < $numPhones; $j++) {
                $phone = new Phone();
                $phone->setNumber($this->generateRandomPhoneNumber());
                $phone->setContacts($contact);

                $manager->persist($phone);
            }
            $manager->persist($contact);
        }
        $manager->flush();
    }

    private function generateRandomPhoneNumber(): string
    {
        $ddd       = ['11', '21', '31', '41', '51', '34'];
        $randomDdd = $ddd[array_rand($ddd)];

        $numero = '';

        for ($i = 0; $i < 8; $i++) {
            $numero .= rand(0, 9);
        }

        return $randomDdd . $numero;
    }
}
