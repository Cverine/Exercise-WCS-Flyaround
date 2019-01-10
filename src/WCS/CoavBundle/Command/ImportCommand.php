<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 13/11/17
 * Time: 09:41
 */

namespace WCS\CoavBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Style\SymfonyStyle;
use WCS\CoavBundle\Entity\Airport;
use WCS\CoavBundle\Service\Import\convertCsvToArrayService;



class ImportCommand extends ContainerAwareCommand
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;

    }

    protected function configure()
    {
        $this
            ->setName('import:csv')
            ->setDescription('imports a csv file with french airports informations');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Loading the data...');
        $now = new \DateTime();
        $io->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

        $this->import($input, $output);

        $io->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
        $io->success('The import is done and command exited cleanly!');
    }

    protected function import(InputInterface $input, OutputInterface $output)
    {
        $data = $this->get($input, $output);
        $size = count($data);
        $progress = new ProgressBar($output, $size);
        $progress->start();

        foreach ($data as $row) {
            $terrain = $this->em->getRepository(Airport::class)->findOneBy([
                'icao'=> $row['icao']
        ]);
            if (!is_object($terrain)) {
                $terrain = new Airport();
                $terrain->setIcao($row['icao']);
           }
            $terrain->setName($row['name']);
            $terrain->setLatitude($row['latitude']);
            $terrain->setLongitude($row['longitude']);
            $terrain->setAddress($row['adress']);
            $terrain->setCity($row['city']);
            $terrain->setCountry($row['country']);

            $this->em->persist($terrain);
        }
        $this->em->flush();

        $progress->finish();
    }

    protected function get()
    {
        $filename = 'web/files/french-airports.csv';
        $converter = $this->getContainer()->get('import.csvtoarray');
        $data = $converter->convert($filename, ';');

        return $data;
    }
}