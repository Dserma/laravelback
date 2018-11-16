# laravelback

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravelback

Laravelback é um sistema backend feito em Laravel com AdminLte 2. 
Ele utiliza Ajax Calls, feitos em jQuery, para realizar as ações CRUD, além de utilizar alguns outros componentes, como Datatables, Toastr e etc.
A intenção dele é facilitar a aprendizagem e o uso do AdminLte junto ao Laravel.
Sei que ele não está perfeito e nem que meu código é o melhor do mundo, mas creio que devemos compartilhar o que sabemos, e como vejo muita gente com dificuldade em integrar o AdminLte ao Laravel, resolvi postar.

## Como utilizar

Basta clonar ou baixar todo o código e alterar o <b>.env</b> para os seus dados.
Depois disso, basta rodar o [code] php artisan migrate [/code], para que as tabelas sejam criadas, e logo após, o [code] php artisan db:seed [/code].
O "seed" irá criar as credenciais de acesso, sendo elas:
 - Usuário: admin
 - Senha: admin

Bom "divertimento"!