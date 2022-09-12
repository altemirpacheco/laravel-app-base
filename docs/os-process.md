Vamos utilizar a depedencia do Symfony
vendor/symfony/process/Process.php

Se WSL é preciso gerar uma chave dentro do wsl
> ssh-keygen -t ed25519 -C "your_email@example.com"
> cat sua_chave.pub
Andicionar sua chave em [GitHub -> Configurações -> SSH](https://github.com/settings/keys)
> ssh-add ~/.ssh/id_ed25519

https://docs.github.com/pt/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent