## Executando no Linux

### 1. Inicie os serviços Docker

```sh
docker-compose up -d --build
```

Isso irá construir e iniciar os contêineres necessários.

### 2. Instale as dependências do PHP

```sh
docker-compose run --rm php-fpm composer install
```

Isso garantirá que todas as dependências do PHP sejam instaladas corretamente.

### 3. Popule o banco de dados

```sh
docker-compose run --rm php-fpm composer migrate
```

Isso aplicará todas as migrações pendentes ao banco de dados.

### 4. Execute o Seeder

```sh
docker-compose run --rm php-fpm php Seeder.php
```

Isso preencherá o banco de dados com dados de teste, se necessário.

### 5. Instale as dependências do Vue.js

```sh
cd frontend
npm install
```

Isso garantirá que todas as dependências do Vue.js sejam instaladas corretamente.

### 6. Gere o build

```sh
npm run build
```

Isso compilará e preparará o projeto Vue.js para implantação.

### Ou execute localmente

```sh
npm run serve
```

Isso iniciará um servidor de desenvolvimento local para testar o aplicativo Vue.js.

### Acessando a aplicação

Depois de concluir os passos acima, você pode acessar a aplicação através do navegador:

- **URL:** http://localhost:37001/
- **Usuário:** maue
- **Senha:** test

