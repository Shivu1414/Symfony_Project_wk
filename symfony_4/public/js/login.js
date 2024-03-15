
function cnfLogin(){
     if(statm===0 && statp===0 && statc===0 && trm===1){
        return confirm("Do you really want to login");
     }
     else{
        // alert(statm+" "+statp+" "+statc+" "+trm)
        confirm("Please fill all field correctly");
        return false;
     }
}

var statm=1;
var statp=1;
var statc=1;
var trm=0;
$(document).ready(function () {
    $("#okmail").hide();
    $("#unokmail").hide();
    $("#okpass").hide();
    $("#unokpass").hide();
    $("#okcaptcha").hide();
    $("#unokcaptcha").hide();
    $("#hintcaptcha").hide();
    $("#hint").hide();
    $("#hintpass").hide();
    $("#okcb").hide();
    $("#unokcb").hide();
    $("#hintcb").hide();
    $("#hinttoggle").hide();



    $("#emailVal").keyup(function(){
        let mval=$("#emailVal").val();
        mval=mval.trim();
        const email = document.getElementById("emailVal");
        if(mval.length==""){
            email.classList.add("list-style-r");
            document.getElementById("hint").innerHTML="Field is required";
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
                document.getElementById("hint").innerHTML="Mail is correct";
                $("#unokmail").hide();
                $("#okmail").show();
                statm=0;
            } else {
                email.classList.add("list-style-r");
                document.getElementById("hint").innerHTML="Mail is incorrect";
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


    $(".hcm").hover(function(){
        $("#hint").show();
    },function(){
        $("#hint").hide();
    });  
    
    $(".hcp").hover(function(){
        $("#hintpass").show();
    },function(){
        $("#hintpass").hide();
    }); 

    $(".hcc").hover(function(){
        $("#hintcaptcha").show();
    },function(){ 
        $("#hintcaptcha").hide();
    });

    $(".hcb").hover(function(){
        $("#hintcb").show();
    },function(){ 
        $("#hintcb").hide();
    });

    $(".tgl").hover(function(){
        $("#hinttoggle").show();
    },function(){ 
        $("#hinttoggle").hide();
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
                    document.getElementById("hintcaptcha").innerHTML="Correct";
                }
                else{
                    statc=1;
                    $("#okcaptcha").hide();
                    $("#unokcaptcha").show();
                    document.getElementById("hintcaptcha").innerHTML="Incorrect";
                }
            });
        });


        // function liveError(){
        //     document.getElementById("liveError").style.backgroundcolor = "white";
        // }
