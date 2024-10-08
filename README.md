# Desafio Grand Chef Restaurante
### Nome: Thomas Marcel Guarnieri

## Execução:
1. Após baixar o repositório, tendo docker instalado vai ser possível executar o comando
   ```
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs 
   ```
2. Crie na base do projeto um arquivo chamado `.env` e adicione os seguinte trecho:
   ```
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:5X8xyXudV02167V8A8oSnyBiHaQBnpHTuMK4bEwPag0=
    APP_DEBUG=true
    APP_TIMEZONE=UTC
    APP_URL=http://localhost
    
    APP_LOCALE=en
    APP_FALLBACK_LOCALE=en
    APP_FAKER_LOCALE=en_US
    
    APP_MAINTENANCE_DRIVER=file
    # APP_MAINTENANCE_STORE=database
    
    BCRYPT_ROUNDS=12
    
    LOG_CHANNEL=stack
    LOG_STACK=single
    LOG_DEPRECATIONS_CHANNEL=null
    LOG_LEVEL=debug
    
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=gran_chef
    DB_USERNAME=thomas
    DB_PASSWORD=password
    
    SESSION_DRIVER=database
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null
    
    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=database
    
    CACHE_STORE=database
    CACHE_PREFIX=

    ```
3. Agora é possível acessar o container da aplicação Laravel com o comando `./vendor/bin/sail up -d`
4. Para acessar o container basta executar o comando `./vendor/bin/sail bash`
5. As migrations devem ser executadas com `php artisan migrate`
6. Os testes vão executar com `php artisan test`

## Sobre o desenvolvimento
Inicialmente decidi aplicar exatamente o que li na descrição do desafio, sem tentar incrementar a mais a tarefa, para que ela fosse simples e objetiva. Acredito que a ideia principal seja validar a forma como solucionei os desafios, e não uma aplicação completa.

Utilizei os recursos do Laravel para garantir os dados necessários, como FormRequest e Responses, estes responsáveis por filtrar os dados que vem do request e responder de acordo com o que foi solicitado na estrutura correta.

Optei por me inspirar em um padrão arquitetural chamado `Service Layer`, com mudanças devido a simplicidade do projeto. Meus services carregam apenas parte da lógica relacionada ao negócio deste software, evitando que esta lógica se espalhe pelo projeto. 

Um pequeno detalhe foi a utilização do preço em centavos, buscando evitar futuros problemas com arredondamentos e contas.

Todos os endpoints da aplicação ficam na pasta `endpoints` deste projeto, normalmente podem ser executados através de uma IDE.

A documentação das rotas apresnetadas fica na URL: http://localhost/docs/api caso o projeto esteja rodando localmente. 


