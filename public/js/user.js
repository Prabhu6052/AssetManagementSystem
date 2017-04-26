
function validate() {
    
var test = document.getElementsByClassName("test"); 
var count=0;

       for(var i=0; i<test.length; i++) {
           if(test[i].checked==true){
               count++;
           } 
       } 
       if(count==0) {
           document.getElementById('testing').innerHTML = "click  yes or no  ";
        return false;
       }
      else  if(count==2) {
           document.getElementById('testing').innerHTML = "click only yes or no not both ";
        return false;
       } else {
           return true;
       }
}
      