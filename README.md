<h1 align="center">
  Delivery Backend
</h1>

<p align="center">
  <a href="#-project">Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-technologies">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-how-to-use">Como executar</a>
</p>

<p align="center">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/vitorjc1/Devnology-Back">

  <img alt="GitHub top language" src="https://img.shields.io/github/languages/top/vitorjc1/Devnology-Back">

  <img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/vitorjc1/Devnology-Back">

  <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/vitorjc1/Devnology-Back">
</p>

<br/>

## 💻 Projeto

Este é um projeto backend de delivery feito em laravel, utilizando o padrão CQRS e Clean Code. O projeto foi estruturado em App (Core do laravel, providers, middlewares e controllers), Domain (todas as entidades, com seus respectivos commands, dtos, models e services) e camada de Support (desenvolvido um commandBus personalizado, utilizando reflecção).

O projeto foi arquitetado para cadastrar um cliente novo sempre que uma compra for realizada, cadastrando também o endereço de entrega e os produtos comprados. 
Como um dos requisitos foi a obtenção de produtos via api de fornecedores, que era responsável não somente por trazer todo detalhamento do produto mas também preço, descontos e entre outros, o pensamento adota foi semelhante a outras plataformas de vendas como Mercado Livre. A cada compra, somente detalhes cruciais referente a produtos são salvos, como preço, descontos, e "id externo" para referenciar na api do fornecedor. Dessa forma, se um dia for necessária a implementação de histórico de pedidos do cliente, o preço e descontos serão retornados do banco de dados e detalhes em relação ao produtos serão buscados do fornecedor.

## ℹ️ Como usar

para clonar e executar esta aplicação, você irá precisar [Git](https://git-scm.com) e do [Composer](https://getcomposer.org/download/). Da sua linha de comando:
```bash

#Clonar o repositório
$ git clone https://github.com/vitorjc1/Devnology-Back.git

# Instalar dependências
$ composer install

# Ir para o arquivo de configuração (.env) e alterar os dados de acesso a banco para o seu local

# Executas as migrações no banco de dados
$ php artisan migrate

# Executar em modo de desenvolvimento
$ php artisan serve
```
---

Feito com ♥ por Vitor Cordeiro 👋🏻
