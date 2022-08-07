## Inicialização do projeto

### Passo a passo

Faça o clone do projeto executando:

```sh
git clone https://github.com/leoblanski/tray_test.git
```

Acesse o projeto

```sh
cd tray_test
```

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

Para que seja possível o envio dos e-mails, precisa iniciar o Worker dos Jobs, para isso execute:
```sh
php artisan queue:work
```

Acesse o projeto
[http://localhost:8989](http://localhost:8989)

### Documentação da aplicação

https://docs.google.com/document/d/1G7D3xyyCzXqqgg77kC7nQNunPG2h7Gy1TiNOSiEhXU8/edit?usp=sharing

### Documentação da API

https://documenter.getpostman.com/view/7943547/VUjMoRBd

### Workspace para visualização da API no Postman

https://app.getpostman.com/join-team?invite_code=180e2ac552a25f5a160a0d95ccde0e17&target_code=5a91afc273634080cd9e8b87f08873f5
