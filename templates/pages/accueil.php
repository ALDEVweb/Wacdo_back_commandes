<?php

// Template : affiche la page d'accueil du back office :
//              - si admin : liste des commande non livré, liste des produits, liste des utilisateur
//              - si prep : liste des commande enr et ec
//              - si accueil : liste des commandes livrables
// Paramètres : $userConnecte : utilisateur connecté
//              - si ADMIN: $listeProduits : liste des produits wacdo
//                          $listeUtilisateurs : liste des utilisateur du back office

?>

<div class="large-12">
    <!-- header -->
    <?php include "templates/fragments/header.php"; ?>
    <!-- contenu -->
    <div class="p32 large-12">
        <?php if($statut == "ADMIN" || $statut == "ACC"){ ?>
        <!-- si ADMIN ou ACC --> 
            <!-- bouton saisir une commande -->
            <div class="large-12 flex j-center mt32"><a href="http://exam-front.alaugier.mywebecom.ovh" target="_blank" title="lien de redirection vers l'application borne de commande Wacdo - nouvelle fenêtre"><button>Saisir une commande</button></a></div>
        <?php } ?>    
        <!-- pour tout le monde on affiche la liste des commande -->
            <div class="flex j-center gap32 mt64">
                <!-- liste des commandes -->
                <div>
                    <h2 class="txt-center mb32">Commandes</h2>
                    <div class="liste p16 round8">
                        <ul id="listeCde" class="mb16 flex gap8">
                        </ul>
                    </div>
                </div>
        <?php if ($statut == "ADMIN"){ ?>
            <!-- pour les ADMIN -->
                <!-- liste des produits -->
                <div>
                    <h2 class="txt-center mb32">Produits</h2>
                    <div class="liste p16 round8">
                        <div>
                            <?php
                            // pour chaque categorie de la listeCategories
                            foreach ($listeCategories as $categorie) {
                                $cat = $categorie->nom;
                                echo "<h3 class='mb8'>$cat</h3>";
                                // on recupere les produit qui corresponde
                                $listeProduits = $produit->listAll(["categorie" => $categorie->id]);
                                // on ouvre la balise ul
                                echo "<ul class='mb16 flex gap8'>";
                                // pour chaque produit de la liste
                                foreach ($listeProduits as $produit) {
                                    // on crée une ligne recap du produit
                                    echo $produit->recapProduit($produit);
                                }
                                // on ferme la balise ul
                                echo "</ul>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- liste des utilisateur -->
                <div>
                    <h2 class="txt-center mb32">Collaborateurs</h2>
                    <div class="liste p16 round8">
                        <div class="large-12 flex j-center mb8">
                            <h3 class="large-8 txt-center">Collaborateur</h3>
                            <h3 class="large-4 txt-center">Statut</h3>
                        </div>
                        <ul class="mb16 flex gap8">
                        <?php
                            // pour chaque utilisateur
                            foreach ($listeUtilisateurs as $utilisateur) {
                                // on crée une ligne récap de l'utilisateur
                                echo $utilisateur->recapUtilisateur($utilisateur);
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>