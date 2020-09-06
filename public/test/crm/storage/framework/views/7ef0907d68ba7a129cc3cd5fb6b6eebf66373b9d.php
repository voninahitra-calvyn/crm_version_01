Bonjour <?php echo e($client->prenom); ?> <?php echo e($client->nom); ?>, 
<br/>nous venons de répondre à votre demande. 
Merci de cliquer <a href="http://app.ohmycorp.com/supports/<?php echo e($client->_id); ?>">ici</a> pour suivre la conversation. 
<br/><br/><br/>
Cordialement, <br/>
<?php echo e($staff->prenom); ?>

<?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/supports/mail.blade.php ENDPATH**/ ?>