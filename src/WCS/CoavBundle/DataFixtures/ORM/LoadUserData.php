<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 01/12/17
 * Time: 13:25
 */

namespace WCS\CoavBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use WCS\CoavBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LoadUserData extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create('fr_FR');

       // $user = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user
                ->setUserName($faker->userName)
                ->setFirstName($faker->firstName($gender = null))
                ->setLastName($faker->lastName)
                ->setEmail($faker->freeEmail)
                ->setPhoneNumber($faker->phoneNumber)
                ->setBirthDate($faker->dateTimeBetween($startDate = '-50 years', $endDate = '-20 years'))
                ->setcreationDate($faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'))
                ->setNote($faker->randomDigit)
                ->setPassword($faker->password)
                ->setRole($faker->randomElement(array('1', '2', '3')))
                ->setIsACertifiedPilot($faker->boolean)
                ->setIsActive($faker->boolean);
            $em->persist($user);

        }
        $em->flush();
        //$this->addReference('user', $user[$i]);
    }

    public function getOrder()
    {
        return 1;
    }

}