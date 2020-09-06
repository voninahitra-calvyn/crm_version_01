<!-- <div style="color:red; font-size:14pt;font-family:Arial;"> -->
<div style="color:blue;">
Bonjour <?php echo e($clientMail->prenom); ?> <?php echo e($clientMail->nom); ?>, 
<br/>
Nous venons de mettre en attente le rendez-vous portant la référence <?php echo e($reference); ?>.
<br/>
<br/>
<b>Titre:</b>
<div>
<?php echo $titre_details; ?>

</div>
<b>Date:</b>
<div>
<?php echo $date_rendezvousedit_details; ?>

</div>
<b>Heure:</b>
<div>
<?php echo $heure_rendezvousedit_details; ?>

</div>
<b class="detailsrdv">Adresse:</b>
<div class="detailsrdv">
<?php echo $adresse2; ?>

</div>
<b class="detailsrdv">Note:</b>
<div class="detailsrdv" >
<?php echo $note_details; ?>

</div>
<br/><br/>
Cordialement, <br/>
<!-- <?php echo e($prenom); ?> de Lacentraledurdv.com -->
L’équipe de Lacentraledurdv.com
</div>
<?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/rdvs/mail_RdvAttente.blade.php ENDPATH**/ ?>