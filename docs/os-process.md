Vamos utilizar a depedencia do Symfony
vendor/symfony/process/Process.php

1º
https://github.com/user/repo.git -> git@github.com:USERNAME/REPOSITORY.git

2º Testar conexão
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