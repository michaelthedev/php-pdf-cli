<?php

namespace App\Commands;

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
final class Convert extends Command
{
    private function getService(): HtmlToPdfService
    {
        return new HtmlToPdfService();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $answer = $io->ask('Path to the html file?');
        if (!$answer) {
            $io->warning('Come on, I need an input🤦🏻');

            return $this->execute($input, $output);
        }

        $service = $this->getService();
        $service->setHtmlPath($answer);

        if (!$service->fileExists()) {
            $io->error('File does not exist. Verify the location');

            return $this->execute($input, $output);
        }

        if ($service->save('output.pdf')) {
            $io->success('Pdf generated 🎉. Check output.pdf');
        } else {
            $io->error('Something went wrong');
        }

        return Command::SUCCESS;
    }
}