<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Symfony\Component\Process\Process;

class ProcessOSService
{
    protected Process $process;
    public function __construct(array $commands, protected readonly int $timeout_seconds = 60){
        if(empty($commands)){
            throw new Exception("Commands não deve ser vazio. Exemplo: commands = ['git', 'pull']");
        }
        $this->process = new Process($commands, base_path());
    }

    public function execute():string{
        $this->process->setTimeout($this->timeout_seconds)->run();
        $this->process->wait();
        if($this->process->getErrorOutput())
            throw new Exception($this->process->getErrorOutput());
        return $this->process->getOutput();
    }
}
