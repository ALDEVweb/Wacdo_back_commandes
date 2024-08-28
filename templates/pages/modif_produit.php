<?php

// Template : affiche le formulaire de modification d'un produit
// Paramètre : $produit : le produit à modifier

?>

<div class="contain-form-modif flex j-center a-center">
    <div class="form-modif round8 back-two p32">
        <h2 class="txt-center mb32">Modifier le produit</h2>
        <form action="index.php?controleur=modifier_produit&idProduit=<?=$idProduit?>" method="POST" class="mrlauto">
            <!-- il faudrait insérer un select des catégorie (création d'un genSelect qui crée autant d'option que de catégorie) -->
            <?php echo $produit->genForm("modifProduit", ['nom', 'prix', 'image']) ?>
            <div class="large-12 flex j-center mt16 mb8"><label for="disponible">Disponible</label></div>
            <div class="large-12 flex j-center"><input type="checkbox" name="disponible" id="modifProduit-disponible" <?php if($produit->disponible == true) echo "checked"; ?>></div>
            <div class="large-12 flex j-center mt32"><input class="b-none back-button pad-button round8" type="submit" value="Modifier"></div>
        </form>
    </div>
</div>