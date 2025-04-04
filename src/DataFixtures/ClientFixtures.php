<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 9; $i++) {
            $client = new Client();
            $client->setNom($faker->lastName());
            $client->setPrenom($faker->firstName());
            $client->setEmail($faker->email());
            $client->setTelephone(substr($faker->phoneNumber(), 0, 15));

            $manager->persist($client);
            $this->addReference('client_' . $i, $client); // Stocker une référence pour les RendezvousFixtures
        }

        $manager->flush();
    }
}