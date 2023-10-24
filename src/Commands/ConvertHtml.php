<?php

namespace App\Commands;

use App\Exceptions\PdfServiceException;
use App\Services\HtmlToPdfService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'convert:html',
    description: 'Convert an html file to pdf',
    hidden: false
)]
final class ConvertHtml extends Command
{
    private HtmlToPdfService $htmlToPdfService;

    public function __construct(HtmlToPdfService $htmlToPdfService)
    {
        parent::__construct();

        $this->htmlToPdfService = $htmlToPdfService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $answer = $io->ask('Path to the html file?');
        if (!$answer) {
            $io->warning('Come on, I need an input🤦🏻');

            return $this->execute($input, $output);
        }

        try {

            $this->htmlToPdfService->generate($answer);
            // $pdfPath = $this->htmlToPdfService->getPath();

            $io->success("Pdf generated 🎉🎉🎉\nYou can find it in the `storage` folder");

        } catch (PdfServiceException $e) {

            $io->error($e->getMessage());

            return $this->execute($input, $output);
        }

        return Command::SUCCESS;
    }
}