/*
 * @author Aleksandra Bogicevic 0390/17
 */

function storeActiveNav(inputID){
    //localStorage.clear();
    if(inputID=="")
        inputID=null;
    localStorage.setItem("selectedNavItemId", inputID);
}

function promeniBojuNav(){
 
 var current = document.getElementsByClassName("active");
 if (current[0] != null)
    current[0].className = current[0].className.replace("active", "");

 var selectedID = localStorage.getItem("selectedNavItemId");
 
 if(selectedID != null){
    var el = document.getElementById(selectedID);
    el.className += " active";
 }
   
 
}


function usloviKoriscenja(){
    window.open("usloviKoriscenja");
}

function privacyPolicy(){
    window.open("privacy");
}