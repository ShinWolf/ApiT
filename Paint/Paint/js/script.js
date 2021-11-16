/* 
    Exemple d'utilisation d'un canvas temporaire afin d'obtenir une aide à la création d'une ligne
	Ce fichier est le point d'entrée du programme
 	Ne pas oublier d'appeler envenements.js et formes.js dans votre page HTML
 	Auteur: Julien Le Galès - Nuage-pedagogique.fr
*/



//largeur du canvas
let largeur = 800;
// hauteur du canvas
let hauteur = 400;
let couleur = "#707070";
// J'initialise mon canvas avec la fonction initCanvas définie dans formes.js
canvas = initCanvas(largeur, hauteur, couleur);