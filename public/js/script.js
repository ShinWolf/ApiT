$(document).ready(function () {
    var sel = document.getElementById('sel');
    var selD = document.getElementById('selD');

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

    function cpt() {
        // configuration
        var request = $.ajax({
            url: 'http://s3-4391.nuage-peda.fr/mesCompetence/api/type_competences/'+selD.value, method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        
        request.done(function (vil) {
            
            $.each(vil.competences, function (index, e) {
                var label = document.createElement("label");
                selV.appendChild(label);
                label.innerHTML =  '<input type="checkbox"> <span style="color:white">'+e.libelle +'</span> </br>';
            });
        }); 
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur         
        request.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }


    function typecpt() {
        // configuration
        var request = $.ajax({
            url: 'http://s3-4391.nuage-peda.fr/mesCompetence/api/matieres/'+sel.value, method: "GET", 
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8"); 
            }
        }); 
        request.done(function (dep) {
            var option = document.createElement("option");
                selD.appendChild(option);
                option.innerText = "Sélectionnez une type de competence";
                option.value = 0;
                
            $.each(dep.typeCompetences, function (index, e) {
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
        
        request.done(function (reg) {
            reg.sort(function(a,b){
                if(a.libelle < b.libelle){
                    return -1;
                } else {
                    return 1;
                }
            });
            $.each(reg, function (index, e) {
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
});
