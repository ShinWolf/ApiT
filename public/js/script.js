$(document).ready(function () {
    var sel = document.getElementById('sel');
    var selD = document.getElementById('selD');
    var bt = document.getElementById('bt');
    var resultat = [];
    var userid = $('#idtoi').text();
    var listeCpt = [];
    var lien = "http://s3-4391.nuage-peda.fr/mesCompetence/api/";

    bt.addEventListener("click", btEnvoyer, false);
    sel.addEventListener("change", selChange, false);
    selD.addEventListener("change", selDChange, false);

    function selChange(){
        $("#selD").empty();
        $("#selV").empty();
        if(sel.value != 0){
            typecpt();
        }
    }
    function selDChange(){
        $("#selV").empty();
        if(selD.value != 0){
            cpt();
        }
    }
    
    function attribuer() {
        // configuration
        var request = $.ajax({
            url: lien+'atribuers', method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        
        request.done(function (attribu) {
            $.each(attribu, function (index, e) {
                if(userid == e.user.id ){
                    listeCpt.push(e.competence.id );
                }
            });
        }); 
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur         
        request.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }   
    console.log(listeCpt);

//case a cocher
    function cpt() {
        var request = $.ajax({
            url: lien+'type_competences/'+selD.value, method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        
        request.done(function (cpt) {
            
            $.each(cpt.competences, function (index, e) {
                var label = document.createElement("label");
                selV.appendChild(label);
                label.innerHTML =  '<input class="c" name="cpt" id='+e.id+' type="checkbox" style="color:white"> '+e.libelle +' </br>';  
            });
        }); 
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur         
        request.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }

//select type competence
    function typecpt() {
        // configuration
        var request = $.ajax({
            url: lien+'matieres/'+sel.value, method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        request.done(function (cpt) {
            var option = document.createElement("option");
                selD.appendChild(option);
                option.innerText = "Sélectionnez une type de competence";
                option.value = 0;
                
            $.each(cpt.typeCompetences, function (index, e) {
                    var option = document.createElement("option");
                    selD.appendChild(option);
                    option.innerText = e.libelle;
                    option.value = e.id;
                
            });
        }); 
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur         
        request.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }

//select matiere
    function ajax() {
        // configuration
        var request = $.ajax({
            url: lien+"matieres", method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        
        request.done(function (cp) {
            cp.sort(function(a,b){
                if(a.libelle < b.libelle){
                    return -1;
                } else {
                    return 1;
                }
            });
            $.each(cp, function (index, e) {
                var option = document.createElement("option");
                sel.appendChild(option);
                option.innerText =  e.libelle;
                option.value = e.id;
            });
           
        }); 
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur         
        request.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }    // Appel de la fonction ajax    
    ajax();

//boucle = nb de checkbox verifie si c'est cocher si oui ajoute dans tab qui ajoute dans bd
   function btEnvoyer(){
       var cases = document.getElementsByName('cpt');
        //listeCpt.splice(0, listeCpt.length);
        
        for (var i = 0; i < cases.length; i++) {
            if (cases[i].checked) {
              resultat.unshift(cases[i].id );
              if(verifieTab()== true){
                auth();
                cases[i].checked = false;
              }
              else{
                cases[i].checked = false;
                $('#reussi').text("Competences deja mis")
              }
            }
        }
        
        listeCpt.splice(0, listeCpt.length);
        
    }
//verifie si la personne a au moins 1 competence 
//si elle a un cpt alor on verifie si il a deja cette competence
    function verifieTab(){
        attribuer();
        var bon = false;
        if(listeCpt.length == 0){
            bon = true;
        }else{
        for (var i = 0; i < listeCpt.length; i++) {
            if(resultat[0] == listeCpt[i]){
                i = listeCpt.length;
                bon = false;
            }
            else{
                bon = true;
            }
        }
    }
    return bon;
    }
  //envoie dans BD
      function auth() {
        var request = $.ajax({
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          url: lien+"atribuers",
          method: "POST",
          data: JSON.stringify({
            user: '/mesCompetence/api/users/'+userid,
            competence: '/mesCompetence/api/competences/'+resultat,
    
          }),
          dataType: "json",
          beforeSend: function (xhr) {
            xhr.overrideMimeType("application/json; charset=utf-8");
          }
        });
    
        request.done(function (msg) {
          console.log("reussi");
          $('#reussi').text("Ajout reussi")
          //localStorage.setItem('token', msg.token);
        });
        request.fail(function (jqXHR, textStatus, error) {
          console.log(error);
          $('#reussi').text(error)
        });
    
      }

});
