<?php
/**
 * VulnDB PHP SDK
 *
 * @copyright 2015 Anthon Pang
 *
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace VulnDb\Command;

use Cilex\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use VulnDb\Service\VulnerabilityDatabaseService;

/**
 * Command to update vulndb
 *
 * @author Anthon Pang <anthon.pang@gmail.com>
 */
class UpdateDatabaseCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('update')
             ->setDescription('Update vulnerability database');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getApplication()->getContainer();
        $service   = $container['service.vulnerability_database'];
        $results   = $service->updateDb();

        $output->writeln($results);
    }
}
