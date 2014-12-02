<p>Une demande de réinitialisation de mot de passe a été effecuée. Pour modifier votre mot de passe cliquez sur le lien ci-dessous.
</p>
<?php echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password', $token), true);?>
