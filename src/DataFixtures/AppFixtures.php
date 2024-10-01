<?php

namespace App\DataFixtures;

use App\Entity\Belt;
use App\Entity\Technique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $belts = $this->createBelts($manager);

        foreach ($belts as $belt) {
            $manager->persist($belt);
        }

        $manager->flush();
    }

    private function createBelts(ObjectManager $manager): array
    {
        $yellowBelt = $this->createBelt("yellow", $this->getYellowTechniques(), $manager);
        $greenBelt = $this->createBelt("green", $this->getGreenTechniques(), $manager);
        $blueBelt = $this->createBelt("blue", $this->getBlueTechniques(), $manager);

        return [$yellowBelt, $greenBelt, $blueBelt];
    }

    private function createBelt(string $color, array $techniques, ObjectManager $manager): Belt
    {
        $belt = new Belt();
        $belt->setColor($color);

        foreach ($techniques as $technique) {
            $belt->addTechnique($technique);
            $manager->persist($technique);
        }

        return $belt;
    }

    private function getYellowTechniques(): array
    {
        return [
            $this->createTechnique("Seoi-nage", 1, "https://www.youtube.com/embed/zIq0xI0ogxk?si=dWXgfB_yaj5_FTBJ"),
            $this->createTechnique("O-goshi", 1, "https://www.youtube.com/embed/yhu1mfy2vJ4?si=7NWFUs_LnQ-rorEW"),
            $this->createTechnique("Uki-goshi", 1, "https://www.youtube.com/embed/bPKwtB4lyOQ?si=gVYOoAfqF38HcRi8"),
            $this->createTechnique("Yoko-ukemi", 3, "https://www.youtube.com/embed/JCwK1Ia4jsc?si=kEuX458lSUhrI4wS"),
        ];
    }

    private function getGreenTechniques(): array
    {
        return [
            $this->createTechnique("Uchi-mata", 1, "https://www.youtube.com/embed/iUpSu5J-bgw?si=RD5vUMR90k1DHn7Q"),
            $this->createTechnique("Yoko-ukemi", 3, "https://www.youtube.com/embed/JCwK1Ia4jsc?si=kEuX458lSUhrI4wS"),
        ];
    }

    private function getBlueTechniques(): array
    {
        return [
            $this->createTechnique("Tomoe-nage", 1, "https://www.youtube.com/embed/880WbHvHv6A?si=Q5eqbHgWeo8tTzIk"),
            $this->createTechnique("Waki-gatame", 2, "https://www.youtube.com/embed/8F5p1zuJRG0?si=zGBrOWQWuy15CB9R"),
            $this->createTechnique("Yoko-ukemi", 3, "https://www.youtube.com/embed/JCwK1Ia4jsc?si=kEuX458lSUhrI4wS"),
        ];
    }

    private function createTechnique(string $name, int $category, string $video): Technique
    {
        $technique = new Technique();
        $technique->setName($name);
        $technique->setCategory($category);
        $technique->setVideo($video);

        return $technique;
    }
}
