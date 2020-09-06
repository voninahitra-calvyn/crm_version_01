Bonjour {{ $client->prenom }} {{ $client->nom }}, 
<br/>nous venons de répondre à votre demande. 
Merci de cliquer <a href="http://app.ohmycorp.com/supports/{{ $client->_id }}">ici</a> pour suivre la conversation. 
<br/><br/><br/>
Cordialement, <br/>
{{ $staff->prenom }}
