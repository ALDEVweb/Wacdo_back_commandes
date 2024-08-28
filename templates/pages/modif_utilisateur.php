<?php

// Template : affiche le formulaire de modification d'un utilisateur
// Paramètre : $utilisateur : l'utilisateur à modifier

?>

<div class="contain-form-modif flex j-center a-center">
    <div class="form-modif round8 back-two p32">
        <h2 class="txt-center mb32">Modifier l'utilisateur</h2>
        <form action="index.php?controleur=modifier_utilisateur" method="POST" class="mrlauto">
            <?php echo $utilisateurModif->genForm("modifUtilisateur", ['nom', 'prenom', 'statut', 'mail', 'mdp']) ?>
            <div class="large-12 flex j-center mt32"><input class="b-none back-button pad-button round8" type="submit" value="Modifier"></div>
        </form>
    </div>
    <?php include "templates/fragments/message_erreur.php"; ?>
</div>