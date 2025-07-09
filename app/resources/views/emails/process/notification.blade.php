@component('mail::message')
# Novo Processo Cadastrado

Olá {{ $signatario->nome }},  
Um novo processo foi cadastrado e requer sua aprovação:

**Título:** {{ $processo->titulo }}  
**Descrição:** {{ $processo->descricao }}

@component('mail::button', ['url' => $link])
Aprovar ou Reprovar
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent

