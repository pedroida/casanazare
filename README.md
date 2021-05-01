# Projeto Casa Nazaré

### Requisitos de sistema
-   `composer`
-   `php7.4`
-   `redis`
-   `php-redis`
-   `php-imagick`
-   `postgresql`
-   `node/npm`

### Pré-requisitos para instalação

- Criar banco para a aplicação no postgresql

### Instalação
```sh
cd project
composer install
cp .env.example .env #configurar conexão do banco e serviço de email
php artisan key:generate
php artisan storage:link
php artisan config:clear
php artisan migrate
php artisan db:seed
php artisan upgrade --yes
npm install
npm run dev
```

### Executando a aplicação

```shell
php artisan serv
```

```shell
php artisan horizon #Serviço de filas
```

### Acessando a área administrativa
Para acessar basta abrir o navegador em `http://localhost:8000` com o acesso abaixo:

* email: admin@email.com.br
* senha: 12345678
