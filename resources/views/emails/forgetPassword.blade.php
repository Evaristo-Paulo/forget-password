@component('mail::message')
# Alteração da senha

Olá, {{ $user->name }}, foi solicitada alteração da senha na nossa plataforma. Pode ignorar esta mensagem, caso não tenha sido solicitada por si.

Clica no link abaixo, caso deseja continuar com o processo de alteração da senha.
@component('mail::button', ['url' => session('url')])
Link
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
