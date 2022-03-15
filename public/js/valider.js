$(document).ready(function () {
   
    var lien = "http://s3-4391.nuage-peda.fr/mesCompetence/api/atribuers/";

    
    var idNb;
    var nbVa=0;
   

    
    $(".cpt").click(function(){  
        idNb = this.id;   
        ajax();            
    });

    $(".cpt").dblclick(function(){  
        auth();
                     
    });
    

    function ajax() {
        // configuration
        var request = $.ajax({
            url: lien + idNb, method: "GET",
            dataType: "json",
            beforeSend: function (xhr) {
                xhr.overrideMimeType("application/json; charset=utf-8");
            }
        });

        request.done(function (nbV) {
            
            if(nbV.nbValider==null){
                nbVa = 0;
                nbVa = nbVa+1;
            }else{
                nbVa = nbV.nbValider;
                nbVa = nbVa+1;
            }
            console.log("apres"+nbVa)
        });
        // Fonction qui se lance lorsque l’accès au web service provoque une erreur         
        request.fail(function (jqXHR, textStatus) {
            alert('erreur');
        });
    }  

   
      function auth() {
        var request = $.ajax({
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          url: lien+idNb,
          method: "PUT",
          data: JSON.stringify({
            nbValider: nbVa,
         
        }),
        dataType: "json",
        beforeSend: function (xhr) {
          xhr.overrideMimeType("application/json; charset=utf-8");
        }
      });
  
      request.done(function (msg) {
        location.reload();
        
      });
      request.fail(function (jqXHR, textStatus, error) {
        console.log(error);
      });
  
    }

});
