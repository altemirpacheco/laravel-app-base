<?php

namespace App\Commands;

use App\Services\ProcessOSService;
use Exception;

class GitCommand
{
    protected string $branch = "master";
    const COMMAND = 'git';

    public function __construct(?string $branch = null){
        $branch ? $this->branch = $branch : '';
    }

    public function status():array{
    $process = new ProcessOSService([self::COMMAND, 'status']);
        if($result = $process->execute()){
            if(empty($result))
                throw new Exception("Sem resultado!");
            $result = explode("\n", $result);
            $result = array_values(
            array_filter($result, fn($item) => $item !== "")
            );
            return $result;
        }else{
            throw new Exception("Não executou!");
        }
    }

    public function addAll():array{
        $process = new ProcessOSService([self::COMMAND, 'add',  '.']);
        // $process = new ProcessOSService(['ls']);
        try {
            $process->execute();
            return [
                ["Todos os itens foram adiconados para serem comitados."], "ok"
            ];
        } catch (\Throwable $th) {
            throw new Exception( "Erro na execução!");
        }
    }

    public function pull():array{
        $process = new ProcessOSService([self::COMMAND, 'pull']);
        if($result = $process->execute()){
            if(empty($result))
                throw new Exception("Sem resultado!");            
            $result = explode("\n", $result);
            $result = array_values(
            array_filter($result, fn($item) => $item !== "")
            );
            if($result[0] === "Already up to date."){
                return [
                    ["Projeto está atualizado"], "ok"
                ];
            }
            // "\tnew file:,
            // "\tmodified:
            // "\t
            return [
                $result, "atualizacoes"
            ];
        }else{
            throw new Exception("Não executou!");
        }
    }

    public function commit(string $msg = null):array{
        if(empty($msg)){
            $msg = "'teste'";
            // $msg = "__modificado_em_".now()->toDateTimeString().".";
        }
        // dd([self::COMMAND, 'commit', '-m', $msg]);
        $process = new ProcessOSService(["git", "commit", "-m", "teste"]);
        // $process = new ProcessOSService([self::COMMAND, 'commit', 'message="teste"']);
        if($result = $process->execute()){
            if(empty($result))
                throw new Exception("Sem resultado!");            
            $result = explode("\n", $result);
            $result = array_values(
            array_filter($result, fn($item) => $item !== "")
            );
            if($result[0] === "Already up to date."){
                return [
                    ["Projeto está atualizado"], "ok"
                ];
            }
            return [
                $result, "atualizacoes"
            ];
        }else{
            throw new Exception("Não executou!");
        }
    }

    
}
