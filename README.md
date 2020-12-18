# Passo à passo para execução

Pré-requisitos:

-GIT

 **Via docker**
 

 - Docker instalado. É possível obter através do link: https://docs.docker.com/get-docker/

**Via Servidor Local**

 - PHP 7.3 ou superior instalado https://www.php.net/downloads
 - Composer https://getcomposer.org/download/

 **Passos Via Docker:**

 1. Clone o repositório através do comando `git clone https://github.com/erodrigues-developer/teste-123milhas.git`
 2. Abra a pasta raiz do projeto.
 3. Clone o arquivo .env.example e renomeie para .env
 4. Execute o comando: `docker build -t teste-123milhas .` para criar a imagem.
 5. Execute o comando: `docker run -p8080:80 teste-123milhas`
 
 
**Passos Via  Servidor Local** 
 1. Clone o repositório através do comando `git clone https://github.com/erodrigues-developer/teste-123milhas.git`
 2. Abra a pasta raiz do projeto.
 3. Clone o arquivo .env.example e renomeie para .env
 4. Execute o comando `composer install`.
 5. Execute o comando `php -S localhost:8080 -t public`


- O projeto já está pronto para ser executado, abra o navegador no endereço 

> localhost:8080/docs

 para conferir a documentação da api.
- Para testar o funcionamento da API basta acessar a URL 

> localhost:8080/api/v1/flights
