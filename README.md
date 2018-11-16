# laravelback

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravelback

Laravelback é um sistema backend feito em Laravel com AdminLte 2. <br>
Ele utiliza Ajax Calls, feitos em jQuery, para realizar as ações CRUD, além de utilizar alguns outros componentes, como Datatables, Toastr e etc.<br>
Ele utiliza também o Froala Editor, como editor de textos e como upload de imagens. Gosto do Froala, principalmente para as imagens, pois ele cria um tipo de "galeria de mídia".<br>
A intenção dele é facilitar a aprendizagem e o uso do AdminLte junto ao Laravel.<br>
Sei que ele não está perfeito e nem que meu código é o melhor do mundo, mas creio que devemos compartilhar o que sabemos, e como vejo muita gente com dificuldade em integrar o AdminLte ao Laravel, resolvi postar.

## Como utilizar

Basta clonar ou baixar todo o código e alterar o <b>.env</b> para os seus dados e rodar, dentro da pasta da aplicação:

```console
composer update
```

Depois disso, basta rodar: 
```console
 php artisan migrate 
 ```
 para que as tabelas sejam criadas, e logo após:

```console
php artisan db:seed
```

O "seed" irá criar as credenciais de acesso, sendo elas:
 - Usuário: admin
 - Senha: admin

Para acessar, basta adicionar "/backend" à url de acesso, por exemplo: http://localhost/back/backend.
<br>

Bom "divertimento"!