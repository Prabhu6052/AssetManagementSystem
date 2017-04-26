function validate() {

   
    var assetname = document.form.name1.value;
    var os1 = document.form.os1.value;
    var processor = document.form.processor.value;
    var ram1 = document.form.ram1.value;
    var hd1 = document.form.hd1.value;
    var sl_no = document.form.sl_no.value;
    
   var test = document.getElementsByClassName("test");
   
    
   var count=0;
       for(var i=0; i<test.length; i++) {
           if(test[i].checked==true){
               count++;
           } 
       } 
    
    if (sl_no == "" || sl_no=="null") {
        document.getElementById("sl_no").innerHTML="asset SL_NO required";
        return false;
    }     
    if (count == 0) {
        document.getElementById('testing').innerHTML = "give it is testable device  or not ";
        return false;
    } else if (count == 2) {
        document.getElementById('testing').innerHTML = "check  yes or no and not both  ";
        return false;
    }
    if ( assetname == "" || assetname == "null") {
        document.getElementById('namu').innerHTML = "AssetType name is required ";
        return false;
    }
    else  if (os1 == "" || os1 == "null" ) {
        document.getElementById("os").innerHTML = " asset operating system required";
        return false;
    }
    else if (processor == "" || processor == "null") {
        document.getElementById("proces").innerHTML = "asset processor required ";
        return false;
    }
    else if (ram1 == "" || ram1 == "null") {
        document.getElementById("ram").innerHTML = "asset Ram value  required ";
        return false;
    }
    else if (hd1 == "" || hd1 == "null") {
        document.getElementById("hd").innerHTML = "asset harddisk value required ";
        return false;
    } else {
          return true;
    }
}