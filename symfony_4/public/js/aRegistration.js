function hoverbtn(){
    if(trm===1 && statn==0 && statm==0 && statp==0 && statcp==0 && statc==0){
        const name = document.getElementById("sbt");
        name.classList.add("sbmt");
    }
    else{
        const name = document.getElementById("sbt");
        name.classList.remove("sbmt");
    }
}

function cnfLogin(){
    if(trm===1 && statn==0 && statm==0 && statp==0 && statcp==0 && statc==0){
       return confirm("Do you want to register it");
    }
    else{
       confirm("Please fill all field correctly");
       return false;
    }
}

var statn=1;
var statp=1;
var statcp=1;
var statm=1;
var statc=1;
var trm=0;
$(document).ready(function () {
    $("#okmail").hide();
    $("#unokmail").hide();
    $("#okpass").hide();
    $("#unokpass").hide();
    $("#okname").hide();
    $("#unokname").hide();
    $("#okpasscnf").hide();
    $("#unokpasscnf").hide();
    $("#hintn").hide();
    $("#hintm").hide();
    $("#hintpass").hide();
    $("#hintpasscnf").hide();
    $("#okcaptcha").hide();
    $("#unokcaptcha").hide();
    $("#hintcaptcha").hide();
    $("#okcb").hide();
    $("#unokcb").hide();
    $("#hintcb").hide();


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
            } else {
                name.classList.add("list-style-r");
                document.getElementById("hintn").innerHTML="Name is incorrect";
                $("#unokname").show();
                $("#okname").hide();
                statn=1;
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

    $(".hcb").hover(function(){
        $("#hintcb").show();
    },function(){ 
        $("#hintcb").hide();
    });


});

let p=0;
        function generate(){
            statc=1;
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
                    statc=0;
                    $("#okcaptcha").show();
                    $("#unokcaptcha").hide();
                    document.getElementById("hintcaptcha").innerHTML="Correct captcha";
                }
                else{
                    statc=1;
                    $("#okcaptcha").hide();
                    $("#unokcaptcha").show();
                    document.getElementById("hintcaptcha").innerHTML="Incorrect captcha";
                }
            });
        });


        
        