<?php

declare(strict_types=1);

namespace App\Commands;

use App\Exceptions\PdfServiceException;
use App\Services\WebpageToPdfService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'convert:webpage',
    description: 'Convert a webpage to pdf',
    hidden: false
)]
final class ConvertWebPage extends Command
{
    private WebpageToPdfService $pdfService;

    public function __construct(WebpageToPdfService $pdfService)
    {
        parent::__construct();

        $this->pdfService = $pdfService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $answer = $io->ask('Enter Webpage url');
        if (!$answer) {
            $io->warning('Come on, I need an input🤦🏻');

            return $this->execute($input, $output);
        }

        try {
            $this->pdfService->generate($answer);

            $io->success("Pdf generated 🎉🎉🎉\nYou can find it in the `storage` folder");
        } catch (PdfServiceException $e) {
            $io->error($e->getMessage());

            return $this->execute($input, $output);
        }

        return Command::SUCCESS;
    }
}