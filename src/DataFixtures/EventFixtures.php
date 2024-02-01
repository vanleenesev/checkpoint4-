<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Evenement;
use Faker\Factory;

class EventFixtures extends Fixture
{
public function load(ObjectManager $manager)
{
// Initialiser Faker
$faker = Factory::create('fr_FR'); // Créer une instance de Faker avec localisation française

// Créer un certain nombre d'événements factices
for ($i = 0; $i < 50; $i++) {
$evenement = new Evenement();
$evenement->setTitre($faker->sentence(6)); // Générer un titre d'événement
$evenement->setDescription($faker->text); // Générer une description
$evenement->setDate($faker->dateTimeBetween('-1 years', '+1 years')); // Générer une date entre l'année dernière et l'année prochaine
$evenement->setLieu($faker->city);


// Si vous avez des relations avec d'autres entités (ex: organisateur), ajoutez-les ici
// $evenement->setOrganisateur(...);

$manager->persist($evenement);
}

$manager->flush();
}
}
