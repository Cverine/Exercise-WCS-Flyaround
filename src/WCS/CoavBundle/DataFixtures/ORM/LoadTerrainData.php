<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 01/12/17
 * Time: 11:56
 */

namespace WCS\CoavBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use WCS\CoavBundle\Entity\Terrain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class LoadTerrainData extends Fixture implements OrderedFixtureInterface
{
    /**
     * Load Data fixtures with the passed Entity
     * @param ObjectManager $em
     */
   public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');

       // $terrains = [];
        for ($i = 0; $i < 10; $i++) {
            $terrains = new Terrain;
            $terrains
                ->setName($faker->city)
                ->setIcao($faker->shuffle('ICAO'))
                ->setLatitude($faker->latitude)
                ->setLongitude($faker->longitude)
                ->setAddress($faker->streetAddress)
                ->setCity($faker->city)
                ->setZipCode($faker->postcode)
                ->setCountry("France");
            $em->persist($terrains);

        }
        $em->flush();
        $this->addReference('terrain', $terrains);
    }

    public function getOrder()
    {
        return 2;
    }

}