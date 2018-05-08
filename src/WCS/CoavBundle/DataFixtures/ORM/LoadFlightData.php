<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 01/12/17
 * Time: 11:29
 */

namespace WCS\CoavBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use WCS\CoavBundle\Entity\Flight;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class LoadFlightData extends Fixture implements OrderedFixtureInterface
{
    /**
     * Load Data fixtures with the passed Entity
     *
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');
        $flights = [];
        for ($i = 0; $i < 10; $i++) {
            $flights = new Flight;
            $flights
                ->setNbFreeSeats($faker->randomDigitNotNull)
                ->setSeatPrice($faker->numberBetween($min = 100, $max = 500))
                ->setTakeOffTime($faker->dateTimeThisYear($max = 'now', $timezone = null))
                ->setLandingTime($faker->dateTimeThisYear($max = 'now', $timezone = null))
                ->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true))
                ->setWasDone($faker->boolean);
                // ->setPlaneModel($this->getReference('planeModel' . $i))
              //  ->setUser($this->getReference('user'));
            $em->persist($flights);
            $em->flush();
            //  $this->addReference('flight', $flights[$i]);
        }
    }

    public function getOrder()
    {
        return 3;
    }
}
