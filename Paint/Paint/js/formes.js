// Création d'un canvas
function initCanvas(largeur, hauteur, couleur) {
    // Je créé un pointeur vers le canvas de la page HTML
    let canvas = document.getElementById('canvas');
    // Je précise la largeur du canvas
    canvas.setAttribute('width', largeur);
    // Je précise la longueur du canvas
    canvas.setAttribute('height', hauteur);
    // Je lance la fonction canvasMouseMove si je bouge la souris
    canvas.addEventListener('mousemove', e => canvasMouseMove(canvas, e), false);
    // Je lance la fonction canvasMouseDown si j'appuie sur le bouton gauche de la souris
    canvas.addEventListener('mousedown', e => canvasMouseDown(canvas, e), false);
    // Je lance la fonction canvasMouseUp si je relâche le bouton gauche de la souris
    canvas.addEventListener('mouseup', e => canvasMouseUp(canvas, e), false);
    // J'initialise le click à faux  
    canvas.click = false;
    // Je récupère le contexte du canvas
    ctx = canvas.getContext('2d');
    // Je définis une couleur (passée en paramètre) pour le dessin
    ctx.fillStyle = couleur;
    // Je remplis la surface avec cette couleur
    ctx.fillRect(0, 0, largeur, hauteur);
    // Je créé un canvas temporaire de la même taille que le canvas principal
    canvas.temporaire = document.createElement('canvas');
    canvas.temporaire.width = canvas.width;
    canvas.temporaire.height = canvas.height;
    // Je créé le pointeur vers le contexte du canvas temporaire
    canvas.temporaireCtx = canvas.temporaire.getContext('2d');
    // Je retourne le canvas
    return canvas;
}

//Dessine une ligne
function drawLine(canvas, x1, y1, x2, y2) {
    ctx = canvas.getContext('2d');
    ctx.beginPath();
    ctx.moveTo(x1, y1);
    ctx.lineTo(x2, y2);
    ctx.stroke();
    ctx.strokeStyle = colClick();
    ctx.lineWidth = tailleChange();
}

// Dessine une image
function drawImage(canvas, x, y, image) {
    ctx = canvas.getContext('2d');
    ctx.drawImage(image, x, y);
}

var col = document.getElementById('head');
var eff = document.getElementById('eff');
var fond = document.getElementById('fond');
var taille = document.getElementById('taille');
var cercle = document.getElementById('cercle');

col.addEventListener('click', colClick, false);
eff.addEventListener('click', effClick, false);
fond.addEventListener('click', fondClick, false);
taille.addEventListener('change', tailleChange, false);
cercle.addEventListener('click', cercleClick, false);

function cercleClick() {
    ctx = canvas.getContext("2d");
    ctx.beginPath();
    ctx.fillStyle = colClick();
    ctx.lineWidth = tailleChange();
    ctx.arc(80, 80, 70, 0, 2 * Math.PI);
    ctx.fill();
}

function tailleChange() {
    if (taille.value == 1) {
        ctx.lineWidth = taille.children[0].innerText;
    } else if (taille.value == 2) {
        ctx.lineWidth = taille.children[1].innerText;
    } else if (taille.value == 3) {
        ctx.lineWidth = taille.children[2].innerText;
    } else if (taille.value == 4) {
        ctx.lineWidth = taille.children[3].innerText;
    } else if (taille.value == 5) {
        ctx.lineWidth = taille.children[4].innerText;
    } else if (taille.value == 6) {
        ctx.lineWidth = taille.children[5].innerText;
    }
}

function fondClick(couleur) {
    ctx.fillStyle = fond.value;
    console.log(fond.value);
}

function effClick() {
    initCanvas(largeur, hauteur, couleur);
}

function colClick() {
    ctx.strokeStyle = col.value;
}