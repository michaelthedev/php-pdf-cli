<?php

declare(strict_types=1);

namespace App\Services\Abstract;

use App\Interfaces\Pdf\PdfGeneratorInterface;
use App\Interfaces\PdfServiceInterface;

abstract class PdfService implements PdfServiceInterface
{
    protected string $savePath;
    protected PdfGeneratorInterface $generator;

    public function __construct(PdfGeneratorInterface $generator, string $savePath)
    {
        $this->savePath = $savePath;
        $this->generator = $generator;
    }

    public function save(string $path): bool
    {
        return copy($path, $this->savePath . 'output.pdf');
    }

    public function getPath(): string
    {
        return $this->savePath;
    }
}