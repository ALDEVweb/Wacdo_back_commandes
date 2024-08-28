<?php

// template : affiche le detail de la commande à préparer
// parametre : $userConnecte : utilisateur connecté
//             $commande : la commande a afficher
//             $listeCompos : la liste des composition d'une commande


// préparation des variable

// conso
if($commande->consommation == "SP") $conso ="Sur Place";
else if($commande->consommation == 'AE') $conso = "A Emporter";

// heure
$dateTimeCde = new DateTime($commande->date);
$timeCde = $dateTimeCde->format('H:i');

// récupération du nombre de checkbox qui sera créé
$nbrCheckbox = 0;
foreach($listeCompos as $compo){
    if(!is_null($compo->produit)) $nbrCheckbox += 1;
    else if (!is_null($compo->menu)) $nbrCheckbox += 4;
}

?>
<div class="contain-form-prepa flex j-center a-center">
    <div id="contain-checklist" class="mrlauto p16 round8 flex j-center"> 
        <div>
            <div>
                <h3 class="txt-center mb16">Commande n°<?= $idCommande ?></h3>
                <p class="mb8">Consommation <?= $conso ?></p>
                <p class="mb32">Enregistrement n°<?= $commande->enregistrement ?> à <?= $timeCde ?></p>
            </div>
            <form action="index.php?controleur=modifier_etat_cde&idCommande=<?= $idCommande ?>&nbrCheckbox=<?= $nbrCheckbox ?>" method="POST">
                <?php 
                    foreach($listeCompos as $compo) $compo->genCheckList();
                ?>
                <div class="large-12 flex j-center">
                    <input class="button b-none back-button round8 pad-button mt32" type="submit" value="Envoyer">
                </div>
            </form>
            <?php include "templates/fragments/message_erreur.php"; ?>
        </div>
    </div>
</div>
