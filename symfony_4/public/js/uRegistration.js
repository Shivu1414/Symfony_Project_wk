function hoverbtn(){
    if(trm==1 && statn==0 && statln==0 && statay==0 && statgen==0 && statp==0 && statcp==0 && statm==0 && statphn==0  && statc==0 && statimg==0 ){
        const name = document.getElementById("sbt");
        name.classList.add("sbmt");
    }
    else{
        const name = document.getElementById("sbt");
        name.classList.remove("sbmt");
    }
}

function cnfRegister(){
    if(trm==1 && statn==0 && statln==0 && statay==0 && statgen==0 && statp==0 && statcp==0 && statm==0 && statphn==0  && statc==0 && statimg==0 ){
        return confirm("Do you want to register it");
    }
    else
    {
          confirm("Please fill all field correctly");
          return false;
    }
}

var statn=1;
var statpin=1;
var statln=1;
var statay=1;
var statgen=1;
var statp=1;
var statcp=1;
var statm=1;
var statphn=1;
var statc=1;
var statimg=1;
var trm=0;

$(document).ready(function () {
    $("#okmail").hide();
    $("#unokmail").hide();
    $("#okpass").hide();
    $("#unokpass").hide();
    $("#okphn").hide();
    $("#unokphn").hide();
    $("#okname").hide();
    $("#unokname").hide();
    $("#oklname").hide();
    $("#unoklname").hide();
    $("#okpasscnf").hide();
    $("#unokpasscnf").hide();
    $("#okcb").hide();
    $("#unokcb").hide();
    $("#hintn").hide();
    $("#hintln").hide();
    $("#hintm").hide();
    $("#hintphn").hide();
    $("#hintpass").hide();
    $("#hintpasscnf").hide();
    $("#okcaptcha").hide();
    $("#unokcaptcha").hide();
    $("#hintcaptcha").hide();
    $("#okabout").hide();
    $("#unokabout").hide();
    $("#hintabout").hide();
    $("#okgender").hide();
    $("#unokgender").hide();
    $("#hintgender").hide();
    $("#okimg").hide();
    $("#unokimg").hide();
    $("#hintimg").hide();
    $("#hintcb").hide();
    $("#okpin").hide();
    $("#unokpin").hide();
    $("#hintpin").hide();
    $("#okadd").hide();
    $("#unokadd").hide();
    $("#hintadd").hide();


    $("#nameVal").keyup(function(){
        let nval=$("#nameVal").val();
        nval=nval.trim();
        const name = document.getElementById("nameVal");
        if(nval.length==""){
            name.classList.add("list-style-r");
            document.getElementById("hintn").innerHTML="Field is required";
            $("#okname").hide();
            $("#unokname").show();
            statn=1;
        }
        else{
            let regex = /^[a-zA-Z-' ]*$/;
            let s = name.value;
            if (regex.test(s)) {
                name.classList.remove("list-style-r");
                name.classList.add("list-style-g");
                document.getElementById("hintn").innerHTML="Name is correct";
                $("#unokname").hide();
                $("#okname").show();
                statn=0;
            }
            else {
                name.classList.add("list-style-r");
                document.getElementById("hintn").innerHTML="Name is incorrect";
                $("#unokname").show();
                $("#okname").hide();
                statn=1;
            }
        }
    });

    $("#lnameVal").keyup(function(){
        let nval=$("#lnameVal").val();
        nval=nval.trim();
        const name = document.getElementById("lnameVal");
        if(nval.length==""){
            name.classList.add("list-style-r");
            document.getElementById("hintln").innerHTML="Field is required";
            $("#oklname").hide();
            $("#unoklname").show();
            statln=1;
        }
        else{
            let regex = /^[a-zA-Z-' ]*$/;
            let s = name.value;
            if (regex.test(s)) {
                name.classList.remove("list-style-r");
                name.classList.add("list-style-g");
                document.getElementById("hintln").innerHTML="Name is correct";
                $("#unoklname").hide();
                $("#oklname").show();
                statln=0;
            }
            else {
                name.classList.add("list-style-r");
                document.getElementById("hintln").innerHTML="Name is incorrect";
                $("#unoklname").show();
                $("#oklname").hide();
                statln=1;
            }
        }
    });

    $("#emailVal").keyup(function(){
        let mval=$("#emailVal").val();
        mval=mval.trim();
        const email = document.getElementById("emailVal");
        if(mval.length==""){
            email.classList.add("list-style-r");
            document.getElementById("hintm").innerHTML="Field is required";
            $("#unokmail").show();
            $("#okmail").hide();
            statm=1;
        }
        else{
            let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
            let s = email.value;    

            if (regex.test(s)) {
                email.classList.remove("list-style-r");
                email.classList.add("list-style-g");
                document.getElementById("hintm").innerHTML="Email is correct";
                $("#unokmail").hide();
                $("#okmail").show();
                statm=0;
            } else {
                email.classList.add("list-style-r");
                document.getElementById("hintm").innerHTML="Email is incorrect";
                $("#unokmail").show();
                $("#okmail").hide();
                statm=1;
        }
        }
    });


    $("#phnVal").keyup(function(){
        let pval=$("#phnVal").val();
        pval=pval.trim();
        const phn = document.getElementById("phnVal");
        if(pval.length==""){
            phn.classList.add("list-style-r");
            document.getElementById("hintphn").innerHTML="Field is required";
            $("#unokphn").show();
            $("#okphn").hide();
            statphn=1;
        }
        else{
            let regex =/^\d{10}$/;
            let s = phn.value;    

            if (regex.test(s)) {
                phn.classList.remove("list-style-r");
                phn.classList.add("list-style-g");
                document.getElementById("hintphn").innerHTML="Phone no. is correct";
                $("#unokphn").hide();
                $("#okphn").show();
                statphn=0;
            } else {
                phn.classList.add("list-style-r");
                document.getElementById("hintphn").innerHTML="Phone no. is incorrect";
                $("#unokphn").show();
                $("#okphn").hide();
                statphn=1;
        }
        }
    });

    $("#pinVal").keyup(function(){
        let pinval=$("#pinVal").val();
        pinval=pinval.trim();
        const pin = document.getElementById("pinVal");
        if(pinval.length==""){
            pin.classList.add("list-style-r");
            document.getElementById("hintpin").innerHTML="Field is required";
            $("#unokpin").show();
            $("#okpin").hide();
            statpin=1;
        }
        else{
            let regex =/^\d{6}$/;
            let s = pin.value;    

            if (regex.test(s)) {
                pin.classList.remove("list-style-r");
                pin.classList.add("list-style-g");
                document.getElementById("hintpin").innerHTML="Pin code is correct";
                $("#unokpin").hide();
                $("#okpin").show();
                statpin=0;
            } else {
                pin.classList.add("list-style-r");
                document.getElementById("hintpin").innerHTML="Pin code is incorrect";
                $("#unokpin").show();
                $("#okpin").hide();
                statpin=1;
        }
        }
    });


    $("#habout").keyup(function(){
        let aval=$("#habout").val();
        aval=aval.trim();
        if (aval.length == 0) {
            document.getElementById("hintabout").innerHTML = " Field is required";
            $("#okabout").hide();
            $("#unokabout").show();
            statay=1;
        } 
        else{
          document.getElementById("hintabout").innerHTML = "Content is ok";
          $("#okabout").show();
          $("#unokabout").hide();
          statay=0;
        }
    });

    $("#haddress").keyup(function(){
        let adval=$("#haddress").val();
        adval=adval.trim();
        if (adval.length == 0) {
            document.getElementById("hintadd").innerHTML = " Field is required";
            $("#okadd").hide();
            $("#unokadd").show();
            statad=1;
        } 
        else{
          document.getElementById("hintadd").innerHTML = "Content is ok";
          $("#okadd").show();
          $("#unokadd").hide();
          statad=0;
        }
    });


    $(".gendr").change(function(){
        let gval=$("#gen").val();
        if (gval.length == 0) {
            document.getElementById("hintgender").innerHTML = " Field is required";
            $("#okgender").hide();
            $("#unokgender").show();
            statgen=1;
        } 
        else{
          document.getElementById("hintgender").innerHTML = "Field selected";
          $("#okgender").show();
          $("#unokgender").hide();
          statgen=0;
        }
    });

    $("#fileToUpload").change(function(){
        const size = (this.files[0].size / 1024 / 1024).toFixed(2);       
        if (size <1) {
            document.getElementById("hintimg").innerHTML = "File is below the size of 1 MB";
            $("#okimg").show();
            $("#unokimg").hide(); 
            let tag=0;
            let ival=$("#fileToUpload").val();
            var allowed_extensions = new Array("jpg","png","gif","jpeg");
            var file_extension = ival.split('.').pop().toLowerCase(); 
            
            for(var i = 0; i <= allowed_extensions.length; i++)
            {
                if(allowed_extensions[i]==file_extension){
                document.getElementById("hintimg").innerHTML = "Correct extention and Size";
                $("#okimg").show();
                $("#unokimg").hide();
                statimg=0;
                tag=1;
                break;
               }
            }               
        } 
        else {
            document.getElementById("hintimg").innerHTML = "This file size is: " + size + "MB ";
            $("#okimg").hide();
            $("#unokimg").show();    
        }
        if(tag===0){
            document.getElementById("hintimg").innerHTML = "Incorrect extention";
            $("#okimg").hide();
            $("#unokimg").show();
            statimg=1;
        }
     });

    $("#passVal").keyup(function(){
        let pval=$("#passVal").val();
        pval=pval.trim();
        const pass = document.getElementById("passVal");
        if(pval.length==""){
            pass.classList.add("list-style-r");
            document.getElementById("hintpass").innerHTML="Field is required";
            $("#okpass").hide();
            $("#unokpass").show();   
            statp=1;     
        }
        else if(pval.length < 3 || pval.length > 10){
            pass.classList.add("list-style-r");
            document.getElementById("hintpass").innerHTML="Password is incorrect";
            $("#okpass").hide();
            $("#unokpass").show();  
            statp=1;      
            } else {
                pass.classList.remove("list-style-r");
                pass.classList.add("list-style-g");
                document.getElementById("hintpass").innerHTML="Password is correct";
                $("#okpass").show();
                $("#unokpass").hide(); 
                statp=0;           
            }
    });

    $("#passCnfVal").keyup(function(){
        let pval=$("#passVal").val();
        pval=pval.trim();
        let pcval=$("#passCnfVal").val();
        pcval=pcval.trim();
        const passc = document.getElementById("passCnfVal");
        if(pcval.length==""){
            passc.classList.add("list-style-r");
            document.getElementById("hintpasscnf").innerHTML="Field is required";
            $("#okpasscnf").hide();
            $("#unokpasscnf").show(); 
            statcp=1;       
        }
        else if(pcval.length < 3 || pcval.length > 10){
            passc.classList.add("list-style-r");
            document.getElementById("hintpasscnf").innerHTML="Password is incorrect";
            $("#okpasscnf").hide();
            $("#unokpasscnf").show(); 
            statcp=1;       
        } 
        else if(pval==pcval){
            passc.classList.remove("list-style-r");
            passc.classList.add("list-style-g");
            document.getElementById("hintpasscnf").innerHTML="Password matched";
            $("#okpasscnf").show();
            $("#unokpasscnf").hide();
            statcp=0;
        }
        else {
                passc.classList.remove("list-style-r");
                passc.classList.add("list-style-g");
                document.getElementById("hintpasscnf").innerHTML="Password not matched";
                $("#okpasscnf").hide();
                $("#unokpasscnf").show(); 
                statcp=1;       
             }
    });

    $("#checkbox").change(function(){
        if ( checkbox.checked ) {
            document.getElementById("hintcb").innerHTML = "User Agreed";
            $("#okcb").show();
            $("#unokcb").hide();
            trm=1;
        } 
        else{
          document.getElementById("hintcb").innerHTML = "Field is required";
          $("#okcb").hide();
          $("#unokcb").show();
          trm=0;
      }
    });




    $(".hcc").hover(function(){
        $("#hintcaptcha").show();
    },function(){ 
        $("#hintcaptcha").hide();
    });

    $(".hcn").hover(function(){
        $("#hintn").show();
    },function(){ 
        $("#hintn").hide();
    });

    $(".hcln").hover(function(){
        $("#hintln").show();
    },function(){ 
        $("#hintln").hide();
    });

    $(".hcm").hover(function(){
        $("#hintm").show();
    },function(){ 
        $("#hintm").hide();
    });

    $(".hcp").hover(function(){
        $("#hintpass").show();
    },function(){ 
        $("#hintpass").hide();
    });

    $(".hcpc").hover(function(){
        $("#hintpasscnf").show();
    },function(){ 
        $("#hintpasscnf").hide();
    });

    $(".habt").hover(function(){
        $("#hintabout").show();
    },function(){ 
        $("#hintabout").hide();
    });

    $(".hg").hover(function(){
        $("#hintgender").show();
    },function(){ 
        $("#hintgender").hide();
    });

    $(".himg").hover(function(){
        $("#hintimg").show();
    },function(){ 
        $("#hintimg").hide();
    });

    $(".hcph").hover(function(){
        $("#hintphn").show();
    },function(){ 
        $("#hintphn").hide();
    });

    $(".hcb").hover(function(){
        $("#hintcb").show();
    },function(){ 
        $("#hintcb").hide();
    });

    $(".hpin").hover(function(){
        $("#hintpin").show();
    },function(){ 
        $("#hintpin").hide();
    });

    $(".hadd").hover(function(){
        $("#hintadd").show();
    },function(){ 
        $("#hintadd").hide();
    });

});

let p=0;
        function generate(){
            let x = Math.floor((Math.random() * 10000) + 12245);
            p=x;
            document.getElementById("random").innerHTML=x;
        }

        $(document).ready(function(){
            $("#captch").keyup(function(){
                let cph=$("#captch").val();
                cph=cph.trim();
                cph=Number(cph);

                if(cph===p){
                    $("#okcaptcha").show();
                    $("#unokcaptcha").hide();
                    document.getElementById("hintcaptcha").innerHTML="Correct captcha";
                    statc=0;
                }
                else{
                    $("#okcaptcha").hide();
                    $("#unokcaptcha").show();
                    document.getElementById("hintcaptcha").innerHTML="Incorrect captcha";
                    statc=1;
                }
            });
        });


