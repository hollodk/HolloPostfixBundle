<?php

namespace ITG\PostfixBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TransportCommand extends ContainerAwareCommand
{

  protected function configure()
  {
    parent::configure();

    $this
      ->setName('pf:transport')
      ->setDescription('Postfix Transport')
      ->addOption('domain', null, InputOption::VALUE_REQUIRED, 'What is the domainname?')
      ->addOption('transport', null, InputOption::VALUE_REQUIRED, 'What is the transport?')
      ;
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $options = $input->getOptions();

    $transport = new \ITG\PostfixBundle\Entity\Transport;
    $transport->setDomain($options['domain']);
    $transport->setTransport($options['transport']);

    $em = $this->getContainer()->get('doctrine.orm.entity_manager');
    $em->persist($transport);
    $em->flush();

    return 0;
  }
}
