# teste_tecnico_laravel
Teste Técnico para Desenvolvedor PHP/Laravel


## Pré-requisitos

Antes de começar, certifique-se de ter o Composer instalado na sua máquina. Caso não tenha, você pode baixar e instalar o Composer pelo site oficial:

[https://getcomposer.org/](https://getcomposer.org/)

---

## Instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-projeto.git

2. Dentro da Pasta do projeto, rodar o comando:
   ```bash
   docker compose up -d

3. Listar os containers docker:
   ```bash
   sudo docker ps -a

4. conctar ao container do laravel:
   ```bash
   sudo docker exec -it teste_tecnico_laravel bash

5. rodar as migrations
   ```bash
   php artisan migrate

Neste projeto de teste técnico, não é necessário atualizar manualmente o arquivo .env.
Para facilitar a configuração do ambiente, o arquivo .env foi incluído no repositório (não está no .gitignore).

⚠️ Em ambientes reais, por questões de segurança, o arquivo .env nunca deve ser versionado. Ele deve ser criado localmente e configurado corretamente antes de executar as migrations ou iniciar o sistema.

## Observacoes 

1. Este projeto não utiliza Laravel Mix. Por se tratar de um teste técnico, os arquivos CSS e JS foram adicionados diretamente em public/

2. 
