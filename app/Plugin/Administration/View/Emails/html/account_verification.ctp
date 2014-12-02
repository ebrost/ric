<?php echo sprintf('Bonjour %s ,',$user[$model]['username'] ); ?><br/>
Pour valider votre compte , veuillez visiter l'URL ci-dessous dans les prochaines 24 h :<br/>
</p>
<?php echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'verify', 'email', $user[$model]['email_token']), true);?>
