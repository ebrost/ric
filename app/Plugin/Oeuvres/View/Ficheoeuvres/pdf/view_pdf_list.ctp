

<?php foreach ($fichesoeuvres as $ficheoeuvre): ?>



    <h2><?php echo $ficheoeuvre['Ficheoeuvre']['nom_complet']; ?></h2>
    <?php if (!empty($ficheoeuvre['Ficheoeuvre']['auteur'])): ?>
        <strong>Auteur(s): </strong><?php echo $ficheoeuvre['Ficheoeuvre']['auteur']; ?>
        <br />
    <?php endif; ?>
    <?php if (!empty($ficheoeuvre['OeuvreGenre'])): ?>
        <?php $separator = ''; ?>
        <strong>Genre(s): </strong>
        <?php
        foreach ($ficheoeuvre['OeuvreGenre'] as $genre):
            echo($separator . $genre['title']);
            $separator = ' - ';
        endforeach;
        ?>
        <br />
    <?php endif; ?>
        
    <?php if (!empty($ficheoeuvre['OeuvreDiscipline'])): ?>
        <?php $separator = ''; ?>
        <strong>Discipline(s): </strong>
        <?php
        foreach ($ficheoeuvre['OeuvreDiscipline'] as $discipline):
            echo($separator . $discipline['title']);
            $separator = ' - ';
        endforeach;
        ?>
        <br />
    <?php endif; ?>
    <?php if (!empty($ficheoeuvre['OeuvreActivite'])): ?>
        <?php $separator = ''; ?>
        <strong>Activites(s): </strong>
        <?php
        foreach ($ficheoeuvre['OeuvreActivite'] as $activite):
            echo($separator .$activite['title']);
            $separator = ' - ';
        endforeach;
        ?>
        <br />
        <?php endif; ?>
<?php if (!empty($ficheoeuvre['Typepublic'])): ?>
        <?php $separator = ''; ?>
        <strong>Publics(s): </strong>
        <?php
        foreach ($ficheoeuvre['Typepublic'] as $typepublic):
            echo($separator .$typepublic['title']);
            $separator = ' - ';
        endforeach;
        ?>
        <br />
        <?php endif; ?>

    <!-- on utilise le code ci-dessous pour verifier le changement de page-->
    <checkForPageBreak>
<?php endforeach; ?>