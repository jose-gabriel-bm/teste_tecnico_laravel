# teste_tecnico_laravel
Teste Técnico para Desenvolvedor PHP/Laravel


## Pré-requisitos

Antes de começar, certifique-se de ter o Composer instalado na sua máquina. Caso não tenha, você pode baixar e instalar o Composer pelo site oficial:

[https://getcomposer.org/](https://getcomposer.org/)

---


## 🛠 Tecnologias Utilizadas

- Laravel 10
- Php 8
- Mailpit (Teste de E-mail)
- Docker
- bootstrap 5

## Instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/jose-gabriel-bm/teste_tecnico_laravel.git
   ```
2. Duplicar arquivo .env.example

3. Renomear a duplicada para .env


4. Dentro da Pasta do projeto, rodar o comando:
   ```bash
   docker compose up -d
   ```

5. Listar os containers docker:
   ```bash
   sudo docker ps -a
   ```

6. conctar ao container do laravel:
   ```bash
   sudo docker exec -it teste_tecnico_laravel bash
   ```

7. rodar as migrations
   ```bash
   php artisan migrate
   ```

8. Startar queue:work
   ```bash
   php artisan queue:work
   ```
  ⚠️ O terminal precisa permanecer aberto com o comando <strong style="color:green">php artisan queue:work</strong> rodando, pois é ele que monitora e executa as tarefas pendentes na fila. Sem isso, processos como envio de e-mails ou outras jobs assíncronas não serão realizados.

9. Para utilizar o sistema, acessar:
   ```bash
   http://localhost:8088/login
   ```
10. Para testar o envio de e-mail, acessar o link
   ```bash
   http://localhost:8025/
   ```


### 📬 Mailpit – Testes de E-mail

No projeto esta sendo usado o Mailpit para testar o envio de e-mails, sem ele nao seria possivel testar a nao ser que usase servidores reais (como Gmail, Outlook ou SMTPs pagos),com ele e possivel testar o envio de e-mail sem enviar nada de verdade para os destinatários. Ele captura os e-mails e mostra tudo numa interface web , acessando pelo navegador.

para testar o envio de e-mail basta acecar o link
   ```bash
   http://localhost:8025/
   ```

### 📧 Fluxo do envio de e-mails.

   ```bash
   Usuário envia o formulário
                  ↓
   Controller recebe a requisição valida os dados com Request
                  ↓
   Controller envia os dados para o service.
                  ↓
   Service cadastra o processo e dispara o Job.
                  ↓
   dispatch(new SendProcessNotification($processo))
                  ↓
   [Job vai para a fila no banco de dados]
                  ↓
   [queue:work fica rodando e "escutando" a fila]
                  ↓
   [Job é executado em segundo plano]
                  ↓
   E-mail é enviado para os signatários

   ```

## 🛡️ Autenticação

validacao simples feita com Auth::attempt.
   ```bash
      $credentials = $request->validate([
          'email' => 'required|email',
          'password' => 'required',
      ]);
      if (!Auth::attempt($credentials)) {
         throw ValidationException::withMessages([
            'email' => ['E-mail ou senha inválidos.'],
         ]);
      }
      $request->session()->regenerate();
      return redirect()
          ->intended('/signatarios/listagem')
          ->with('success', 'Login realizado com sucesso!');
   ```
Verificacao de autenticacao nas rotas, conforme exemplo abaixo:
   ```bash
   Route::prefix('/signatarios')->group(function () {

    Route::get('/listagem', [SignatoryController::class, 'index'])->name('signatory.index')->middleware('auth');

    Route::post('/cadastro', [SignatoryController::class, 'register'])->name('signatory.register')->middleware('auth');

    Route::delete('/delete/{id}', [SignatoryController::class, 'destroy'])->name('signatory.destroy')->middleware('auth');

    Route::post('/update', [SignatoryController::class, 'update'])->name('signatory.update')->middleware('auth');

   });
   ```
## Observacoes 

1. Este projeto não utiliza Laravel Mix. Por se tratar de um teste técnico, os arquivos CSS e JS foram adicionados diretamente em public/
