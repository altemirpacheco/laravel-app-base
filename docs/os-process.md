## Dependências
- Ter o git instalado no ambiente ou no container

- Vamos utilizar a depedência do Symfony. Por padrão ela está em todos os projetos Laravel.
vendor/symfony/process/Process.php

## Comandos 
1º Entrar em .git/config e checar o apontamento ao respositório. Se estiver começando com https://github.com/... alterar conforme exemplo:
https://github.com/user/repo.git -> git@github.com:USERNAME/REPOSITORY.git

2º Testar conexão, deve retornar um erro
ssh -T git@github.com

3º Gerar chave
ssh-keygen -t ed25519 -C "your_email@example.com"

4º Não colocar senha ao gerar a chave

5º Iniciar o agente SSH
eval "$(ssh-agent -s)"

6º Adicionar a chave gerada
ssh-add ~/.ssh/id_ed25519

7º Ir ao GitHub -> settings -> ssh

8º Executar
cat ~/.ssh/id_ed25519.pub

9º Copiar o valor obtido e inserir como valor de uma nova chave no GitHub

10º Testar conexão
ssh -T git@github.com

## Materias de apoio
[Gerando uma nova chave SSH e adicionando-a ao agente SSH](https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)

[Erro: permissão negada (publickey)](https://docs.github.com/pt/authentication/troubleshooting-ssh/error-permission-denied-publickey)

[GitHub configurações de SSH da conta](https://github.com/settings/keys)