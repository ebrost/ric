Votre ami vous recommande les événements suivants:\n

<?php foreach ($links as $link): ?>


<?php echo $this->Html->link($link['nom'],$link['url'])?>\n
				
<?php endforeach; ?>

<?php if (!empty($message)):?>
\n
<?php echo $message; ?>
<?php endif; ?>
