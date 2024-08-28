// fonction de gestion ajax de l'affichage de la liste des commandes
function afficheListeCde(){
    // récupération de la zone d'affichage
    // lancement du controleur ajax
    // et intégration dans le corps du html
    console.log('appel liste')
    let listeCde = document.getElementById('listeCde');
    fetch('index.php?controleur=lister_commande')
    .then(response => response.text())
    .then(data => {
        console.log(data);
        listeCde.innerHTML = data;
    });
}
afficheListeCde();
