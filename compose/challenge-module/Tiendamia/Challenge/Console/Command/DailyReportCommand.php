<?php

declare(strict_types=1);

namespace Tiendamia\Challenge\Console\Command;

use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tiendamia\Challenge\Cron\DailySalesReport;

class DailyReportCommand extends Command
{
    public function __construct(
        private DailySalesReport $dailySalesReport,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('daily:report:command');
        $this->setDescription('This is a test execution of DailyReport cron.');
        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;
        try {
            $output->writeln('Daily report - init');
            $this->dailySalesReport->execute();
            $output->writeln('Daily report - finished');
        } catch (LocalizedException $e) {
            $output->writeln(sprintf(
                '<error>%s</error>',
                $e->getMessage()
            ));
            $exitCode = 1;
        }

        return $exitCode;
    }
}
