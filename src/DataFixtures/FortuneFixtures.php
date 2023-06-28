<?php

namespace App\DataFixtures;

use App\Entity\FortuneCookie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FortuneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 10; $i++) {
            $fortune = new FortuneCookie();
            $fortune->setFortune(sprintf("FortuneCookie-%d", $i));
            $category = $this->getReference('category-' . rand(1, 5));
            $fortune->setCategory($category);
            $manager->persist($fortune);
        }

        $manager->flush();
    }
}
