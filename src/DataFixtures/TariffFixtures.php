<?php


namespace App\DataFixtures;

use App\Domain\Tariff\Entity\Tariff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TariffFixtures
 * @package App\DataFixtures
 */
class TariffFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tariffs = [
            ['Однодневный', 1.00, ['2020-01-10']],
            ['Двухдневный', 2.00, ['2020-01-10', '2020-01-11']],
            ['Трехдневный', 3.00, ['2020-01-10', '2020-01-11', '2020-01-12']],
            ['Четырехдневный', 4.00, ['2020-01-10', '2020-01-11', '2020-01-12', '2020-01-13']]
        ];

        foreach ($tariffs as $tariffData)
        {
            $tariff = new Tariff();
            $tariff->setName($tariffData[0]);
            $tariff->setPrice($tariffData[1]);
            $tariff->setDeliveryDays($tariffData[2]);

            $manager->persist($tariff);
            $manager->flush();
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}