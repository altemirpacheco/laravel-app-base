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
            $msg = "__modificado em ".now()->toDateTimeString().".";
        }
        /**
         * Author identity unknown *** 
         * Please tell me who you are. 
         * Run 
         * git config --global user.email "you@example.com" 
         * git config --global user.name "Your Name" 
         * to set your account's default identity. 
         * Omit --global to set the identity only in this repository.
         */
        $process = new ProcessOSService([self::COMMAND, "commit", "-m", $msg]);
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

    public function setConfigEmail(){
        $user_email = env("GIT_EMAIL", null);
        $process = new ProcessOSService([self::COMMAND, "config", "--global", "user.email", $user_email]);
        if($result = $process->execute()){
            return [
                [$result], 'ok'
            ];
        }else{
            throw new Exception("Não executou!");
        }
    }

    public function setConfigName(){
        $user_name = env("GIT_NAME", null);
        $process = new ProcessOSService([self::COMMAND, "config", "--global", "user.name", $user_name]);
        if($result = $process->execute()){
            return [
                [$result], 'ok'
            ];
        }else{
            throw new Exception("Não executou!");
        }
    }

    public function push():array{
        $process = new ProcessOSService([self::COMMAND, 'push'] );
        if($result = $process->executeWithPty()){
            if(empty($result))
                throw new Exception("Sem resultado!");
            $result = explode("\n", $result);
            $result = array_values(
            array_filter($result, fn($item) => $item !== "")
            );
            return [
                $result, "atualizacoes"
            ];
        }else{
            throw new Exception("Não executou!");
        }
    }
    
}
