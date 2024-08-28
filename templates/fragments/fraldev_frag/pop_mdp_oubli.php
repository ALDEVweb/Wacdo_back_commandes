<?php

// fragment : pop up d'oubli d'un mdp à personnaliser 

// pas terminé, à modifier

use fraldev\classes\Utilisateur;

?>

<div id="pop-oubli" class="pos-rel plein-ecran back-one d-none popup">
    <div class="center-xy large-3 medium-4 small-8 mrlauto p16 round16 formulaire">
        <form class="large-12 medium-12 small-12" action="">
        <h2 class="txt-center txt-two mb32">Mot de passe oublié</h2>
        <?php
            $utilisateur = new Utilisateur();
            echo $utilisateur->genForm("mdpoubli", ["mail"]);
        ?>
        <div class="flex j-center mt32">
            <input class="btn b-none round4 btnPad back-three txt-three" type="submit" value="Envoyer">
        </div>
        </form>
        <a href="index.php"><p class="txt-center mt32">Annuler</p></a>
    </div> 
</div>