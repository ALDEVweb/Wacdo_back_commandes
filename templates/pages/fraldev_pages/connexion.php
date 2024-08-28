<?php

// template : affiche le formulaire de connexion :
//             - champ mail mdp et connecter + mdp oublié + creer cpte + faire une dde de financement
// parametres : error : 1 si prb, 0 sinon (partout)
//              creation : 1 si mail process creation, 0 sinon (connexion)
//              newMdp : 1 si process new mdp, 0 sinon (connexion)
//              mdpOubli : 1 si process oubli, 0 sinon (connexion)
//              verif : 1 si token verif (suite crea), 0 sinon (connexion)
//              dde : 1 si process dde, 0 sinon (action porteur affiche sur connexion)
//              connectEchec : 1 si echec connexion, 0 sinon (connexion)

use fraldev\classes\Utilisateur;

?>
<!-- pop up mdp oublié -->
<?php // include "templates/fragments/fraldev_frag/pop_mdp_oubli.php"; ?>
<div class="center-xy large-3 medium-4 small-8 mrlauto p16 round16 formulaire arriere-plan">
    <form class="large-12 medium-12 small-12" action="index.php?controleur=connecter" method="POST">
        <h2 class="txt-center txt-one mb32">Connexion</h2>
        <?php
            $utilisateur = new Utilisateur();
            echo $utilisateur->genForm("connexion", ["mail", "mdp"]);
            ?>
        <div class="flex j-center mt32">
            <input class="btn b-none round4 btnPad back-button txt-one" type="submit" value="Me connecter">
        </div>
        <?php include "templates/fragments/message_erreur.php"; ?>
    </form>
</div>

        
