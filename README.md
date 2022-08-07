## Inicialização do projeto

### Passo a passo

Crie o Arquivo .env (Todas as configurações necessárias já estão no env.example)
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Execute as migrations do projeto
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8989](http://localhost:8989)

