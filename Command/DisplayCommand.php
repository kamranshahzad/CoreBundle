<?php

namespace Kamran\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayCommand extends Command
{

    /**
     * @see Command
     */
    protected function configure()
    {
        $this->setDefinition(array(
            new InputOption('name','',InputOption::VALUE_REQUIRED , 'Test string will come here.')
        ))
        ->setDescription("Description of commands")
            ->setHelp("Here is Help")
             ->setName('test:demo')
            ->setAliases(array('test:demo'));
    }

    /**
     * @see Command
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$name = $input->getArgument('name');
        $name = $input->getOption('name');
        $output->writeln($name);
    }


}