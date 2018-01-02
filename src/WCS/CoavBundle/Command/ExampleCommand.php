<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 13/11/17
 * Time: 09:41
 */

namespace WCS\CoavBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('flyaround3:example-command')

            // the short description shown while running "php bin/console list"
            ->setDescription('Exemple de commande.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Ceci est un exemple de commande...')
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello!');
        $output->writeln('Username: ' .$input->getArgument('username'));
    }
}