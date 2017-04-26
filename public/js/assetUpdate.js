function validate() {
    var assetname = document.form.name1.value;
    var os1 = document.form.os1.value;
    var processor = document.form.processor.value;
    var ram1 = document.form.ram1.value;
    var hd1 = document.form.hd1.value;

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