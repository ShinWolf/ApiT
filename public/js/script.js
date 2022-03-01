$(document).ready(function () {
    var sel = document.getElementById('sel');
    var selD = document.getElementById('selD');
    var bt = document.getElementById('bt');
    var nb = 0;  
    var cptid;


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
//case a cocher
    function cpt() {
        var request = $.ajax({
            url: 'http://s3-4391.nuage-peda.fr/mesCompetence/api/type_competences/'+selD.value, method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        
        request.done(function (cpt) {
            
            $.each(cpt.competences, function (index, e) {
                var label = document.createElement("label");
                selV.appendChild(label);
                label.innerHTML =  '<input class="c" id='+e.id+' type="checkbox"> <span style="color:white">'+e.libelle +'</span> </br>';
                nb = nb+1;
                console.log("case cocher " + e.id)
               
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
            url: 'http://s3-4391.nuage-peda.fr/mesCompetence/api/matieres/'+sel.value, method: "GET", 
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


    function ajax() {
        // configuration
        var request = $.ajax({
            url: "http://s3-4391.nuage-peda.fr/mesCompetence/api/matieres", method: "GET", 
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

    function btEnvoyer(){
        auth();
        if($('.c').is(':checked')){
            console.log("id"+$('.c').attr('id')) 
            //cptid = $('.c').attr('id');
        }
        
       console.log(nb);
    }
  
      function auth() {
        var request = $.ajax({
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          url: "http://s3-4391.nuage-peda.fr/mesCompetence/api/atribuers",
          method: "POST",
          data: JSON.stringify({
            user: '/mesCompetence/api/users/'+2,
            competence: '/mesCompetence/api/competences/'+9,
    
          }),
          dataType: "json",
          beforeSend: function (xhr) {
            xhr.overrideMimeType("application/json; charset=utf-8");
          }
        });
    
        request.done(function (msg) {
          console.log("reussi");
          //localStorage.setItem('token', msg.token);
        
        });
        request.fail(function (jqXHR, textStatus, error) {
          console.log(error);
        });
    
      }

});
