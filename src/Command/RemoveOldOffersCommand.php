<?php

namespace App\Command;

use App\Entity\JobOffer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RemoveOldOffersCommand extends Command
{
    protected static $defaultName = 'app:remove-old-offers';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->em = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('This command removes old offers')
            ->addArgument('max-days', InputArgument::OPTIONAL, 'Days to consider an offer as old', 90)
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Apply changes or not')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $maxDays = $input->getArgument('max-days');

        $io->note(sprintf('Offers older than %s are considered old', $maxDays));

        $dryRun = true;
        if ($input->getOption('dry-run')) {
            $dryRun = true;
            $io->note('No changes will happen');
        }

        $oldOffers = $this->em->getRepository(JobOffer::class)
            ->createQueryBuilder('jo')
            ->where('jo.created_at < :limitDate')
            ->setParameter('limitDate', new \DateTimeImmutable('today -'.$maxDays.' days'))
            ->getQuery()
            ->getResult()
            ;

        $io->writeln('There are '.count($oldOffers).' old offers');
        foreach ($oldOffers as $oldOffer) {
            $this->em->remove($oldOffer);
            /**
             * @todo: Avisar al responsable de la empresa
             */
            /**
             * @todo: mostrar que esta sucediendo
             */
        }

        $this->em->flush();

        $io->success('All old offers have been removed.');

        return 0;
    }
}
