<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Rendezvous;
use App\Entity\Client;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RendezvousFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 9; $i++) {
            $rendezvous = new Rendezvous();
            
            $rendezvous->setDate($faker->dateTimeBetween('now', '+1 year'));
            $rendezvous->setHeure($faker->dateTimeBetween('08:00:00', '18:00:00'));
            $rendezvous->setDuree($faker->numberBetween(30, 120));
            $rendezvous->setStatut($faker->randomElement(['confirmed', 'pending', 'cancelled']));
            $rendezvous->setRaison($faker->sentence());

            // Associer un client existant
            $clientReference = 'client_' . $i;
            if ($this->hasReference($clientReference, Client::class)) {
                $rendezvous->setClient($this->getReference($clientReference, Client::class));
            }

            $manager->persist($rendezvous);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ClientFixtures::class,
        ];
    }
}