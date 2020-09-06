Bonjour {{ $clientMail->prenom }} {{ $clientMail->nom }}, 
<br/>
Nous venons de prendre un nouveau rendez-vous.
<br/>
<br/>
<b>Titre:</b>
<div>
{!! $titre_details !!}
</div>
<b>Date:</b>
<div>
{!! $date_rendezvousedit_details !!}
</div>
<b>Heure:</b>
<div>
{!! $heure_rendezvousedit_details !!}
</div>
<b class="detailsrdv">Adresse:</b>
<div class="detailsrdv">
{!! $adresse2 !!}
</div>
<b class="detailsrdv">Note:</b>
<div class="detailsrdv" >
{!! $note_details !!}
</div>
<br/><br/>
Cordialement, <br/>
<!-- {{ $prenom }} de Lacentraledurdv.com -->
L’équipe de Lacentraledurdv.com
