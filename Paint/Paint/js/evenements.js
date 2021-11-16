/*
  Fichier comprenant l'implémentation des évênements du canvas
*/


function canvasMouseDown(canvas, e){
  // Je garde en mémoire que j'ai cliqué et ensuite les coordonnées de mon premier point	
  canvas.click = true;
  // Je récupère les coordonnées x du pointeur dans le canvas en retirant la position du canvas en left
  canvas.departX = e.clientX - canvas.getBoundingClientRect().left;
  // Je récupère les coordonnées y du pointeur dans le canvas en retirant la position du canvas en top
  canvas.departY = e.clientY - canvas.getBoundingClientRect().top;
  // Je garde en mémoire l'image actuelle du canvas et je la dessine dans le canvas temporaire
  canvas.temporaireCtx.drawImage(canvas,0,0);

}

function canvasMouseMove(canvas, e){
  // Lorsque je bouge la souris, je veux dessiner uniquement si j'ai appuyé sur le bouton
  if (canvas.click){

    // Je récupère les coordonnées du 2 ème point
    x2 = e.clientX - canvas.getBoundingClientRect().left;
    y2 = e.clientY - canvas.getBoundingClientRect().top;
    // J'affiche sur le canvas, le canvas temporaire pour effacer ma ligne précédente
    drawImage(canvas, 0, 0, canvas.temporaire);
    // Je dessine ma nouvelle ligne
    drawLine(canvas, canvas.departX, canvas.departY, x2, y2);

   }
}

function canvasMouseUp(canvas, e){
	// Je ne suis plus en mode "cliqué""
	canvas.click = false;
}