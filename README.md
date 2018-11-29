# Mini-Projeto "atendimento" para clientes

Projeto "teste" dentro do padrão MVC+S sem o uso de Framework

## Começando

Seguindo estas instruções você irá configurar uma cópia do projeto.

### Pré requisitos

- PHP 7
- Composer
- MySQL

### Instalando

Clone o repositório na raiz do seu web server.
```
git clone https://github.com/effer89/atendimento.git
```
Dentro da pasta do projeto, rode o composer.
```
composer install
```
E importe o dump do banco de dados para um banco previamente criado, aqui usei o nome "atendimento".
```
mysql -u root -p atendimento < db.sql
```
### Requisitos atendidos no projeto

Factory
```
src/Service/TicketsService.php : 36
```
Dependency Injection
```
src/Bootstrap.php : 101
src/Controller/Client.php : 13
```
## Feito com

* [Whoops](https://github.com/filp/whoops) - Gerenciar erros do PHP
* [Http](https://github.com/PatrickLouys/http) - Gerenciar as requisições HTTP
* [FastRoute](nikic/fast-route) - Criar e gerenciar as rotas do projeto
* [Aura View](https://github.com/auraphp/Aura.View) - Usado para controlar os templates do projeto
* [Doctrine2](https://github.com/doctrine/doctrine2) - ORM Doctrine