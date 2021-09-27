# CRUD URLS
Esse projeto consiste em cadastro, edição e delete de URLS, além de cadastrar responses dessas urls rodando uma cron.

## Como rodar

-> Clone o projeto

-> Para testar em localhost utilizar por exemplo uma IDE para programar como o Atom ou Visual Studio Code, o XAMPP para testar no computador pessoal , o Composer como gerenciador de dependências para PHP e um prompt de comando para realizar o PHP ARTISAN SERVE e demais ajustes internos.

-> Entre no root do projeto e rode composer install

-> Após isso, digite php artisan key:generate

-> Crie um banco de dados MySQL com nome brain e defina suas credenciais no .env

-> Rode o migration: php artisan migrate:fresh --seed (Roda com seed junto para criar dados mockados já)


## Testar

-> Após realizar os passos acima deve-se rodar algum servidor como exemplo o XAMPP (pacote com os principais servidores) e no console rodar "php artisan serve"

-> Na AWS o link para acesso é: http://control-urls.sa-east-1.elasticbeanstalk.com/, somente a cron que não está habilitada em prod.
   Ambiente em produção foi utilizado AWS Elastic Beanstalk, RDS com CI/CD integrado com integração com GitHub e acompanhamento de deploy com CodePipeline
   
   P.S: A aplicação foi removida da AWS hoje (27/09/2021) para evitar custos adicionais na conta. Qualquer dúvida entrar em contato comigo.

Na página inicial pode-se logar com um usuário fake:
    Ex: admin@gmail.com
         senha: 123
         
Para rodar local a cron deve-se usar o comando "php artisan schedule:run" no console.
        
## Imagens

Login

![login](https://user-images.githubusercontent.com/36732444/134714336-23d28f51-164a-43a1-b2cf-70e000e38b7e.JPG)


Listagem de URLS

![listagem](https://user-images.githubusercontent.com/36732444/134714408-d0d73d03-7ee4-4536-ae62-fc3ce7470b4b.JPG)


Adicionar URL

![addurl](https://user-images.githubusercontent.com/36732444/134714736-2cda0d41-646b-4fe9-9ef2-db10111b9b71.JPG)

Edição 

![Edição](https://user-images.githubusercontent.com/36732444/134714688-aa611f3f-555c-47cc-bb4d-171376b34ba1.JPG)

Responses

![response](https://user-images.githubusercontent.com/36732444/134715185-9f4000a4-ef12-47c1-8c36-907e61e0c51b.JPG)


