# Church Challenge

## Requerimentos

- [PHP 8](https://www.itsolutionstuff.com/post/how-to-upgrade-php-version-from-74-to-8-in-ubuntuexample.html) (e Apache2) 
- [Symfony 6](https://www.osradar.com/install-symfony-ubuntu-20-04/)
- [Composer](https://getcomposer.org/download/)
- [MySQL](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04-pt)

*Links relacionados com Ubuntu 20.04

## Iniciando o projeto

1. Projeto iniciado com o **Composer**, pelo comando:

       composer create-project symfony/skeleton church_challenge

2. Repositório inicializado com os comandos:

       git init
       git add . && git commit -m "commit inicial do projeto"
       git branch -M main
       git remote add origin git@github.com:heitorschulz/church_challenge.git
       git push -u origin main

3. Após isso, alguns testes iniciais com os comandos para verificar se tudo está ok para começar:

       symfony check:requirements
       bin/console --version

4. Criando um brach no repositório para desenvolver o projeto:

       git checkout -b dev
       git branch -a

5. Iniciando o serviço:
   
       symfony server:start -d

       symfony server:stop

6. Usando Annotations para fazer as configurações dentro do "Controller" (poderia ser utilizado também yaml, xml ou php, mas como não foi especificado qual, annotation servirá bem para este caso):
   
       composer require annotations


7. Adicionando o maker ao projeto:

       composer require doctrine maker or composer require maker


8. Criando o primeiro Controller para as igrejas:

       symfony console make:controller ChurchesController

9. Criando o Controller para os membros: 

       symfony console make:controller MembersController


symfony console debug:router

composer require twig

composer require symfony/orm-pack

composer require --dev symfony/maker-bundle [no, yes]


in .env file:

    DATABASE_URL='mysql://prodUser:ProdPass123&@127.0.0.1:3306/movies?serverVersion=5.7'

!!!!!!! Mudar para variáveis de ambiente...
#################

symfony console doctrine:database:create


symfony console make:entity Church

Explicar a escolha dos campos

symfony console make:entity Member

Explicar a escolha dos campos


symfony console make:entity Member
    church
    ManyToMany or ManyToOne (explicar por que foi escolhido ManyToOne)
    Church
    members
    yes

symfony console make:migration
symfony console doctrine:migrations:migrate


composer require --dev doctrine/doctrine-fixtures-bundle

symfony console doctrine:fixtures:load


npm

composer require symfony/webpack-encore-bundle

npm install

npm run dev

composer require symfony/asset

npm run watch
