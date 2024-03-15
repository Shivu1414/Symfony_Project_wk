function cnfForm(){
    if(statn==0 && statloc==0 && stattitle==0){
       return confirm("Do you really want to Edit it");
    }
    else{
       confirm("Please fill all field correctly");
       return false;
    }
}
function logout(){
       return confirm("Do you really want to Logout");
}

var trm=0;
var statn=1;
var statm=1;
var statloc=1;
var stattitle=1;

$(document).ready(function () {
    $("#okname").hide();
    $("#unokname").hide();
    $("#okmail").hide();
    $("#unokmail").hide();
    $("#okimg").hide();
    $("#unokimg").hide();
    $("#oklocation").hide();
    $("#unoklocation").hide();
    $("#oktitle").hide();
    $("#unoktitle").hide();
    $("#hintn").hide();
    $("#hintm").hide();
    $("#hintimg").hide();
    $("#hintloc").hide();
    $("#hinttitle").hide();
 


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

    $("#locVal").keyup(function(){
        let lval=$("#locVal").val();
        lval=lval.trim();
        const location = document.getElementById("locVal");
        if(lval.length==""){
            location.classList.add("list-style-r");
            document.getElementById("hintloc").innerHTML="Field is required";
            $("#oklocation").hide();
            $("#unoklocation").show();
            statloc=1;
        }
        else{
                location.classList.remove("list-style-r");
                location.classList.add("list-style-g");
                document.getElementById("hintloc").innerHTML="Field is filled";
                $("#unoklocation").hide();
                $("#oklocation").show();
                statloc=0;
        }
        });

        $("#titleVal").keyup(function(){
            let tval=$("#titleVal").val();
            tval=tval.trim();
            const title = document.getElementById("titleVal");
            if(tval.length==""){
                title.classList.add("list-style-r");
                document.getElementById("hinttitle").innerHTML="Field is required";
                $("#oktitle").hide();
                $("#unoktitle").show();
                stattitle=1;
            }
            else{
                    title.classList.remove("list-style-r");
                    title.classList.add("list-style-g");
                    document.getElementById("hinttitle").innerHTML="Field is filled";
                    $("#unoktitle").hide();
                    $("#oktitle").show();
                    stattitle=0;
            }
            });

            $("#fileToUpload").change(function(){
                let tag=0;
                let ival=$("#fileToUpload").val();
                var allowed_extensions = new Array("jpg","png","gif","jpeg");
                var file_extension = ival.split('.').pop().toLowerCase(); 
                
                for(var i = 0; i <= allowed_extensions.length; i++)
                {
                    if(allowed_extensions[i]==file_extension)
                {
                    document.getElementById("hintimg").innerHTML = "Correct extention";
                    $("#okimg").show();
                    $("#unokimg").hide();
                    trm=1;
                    tag=1;
                    break;
                }
                }
                if(tag===0){
                    document.getElementById("hintimg").innerHTML = "Incorrect extention";
                    $("#okimg").hide();
                    $("#unokimg").show();
                    trm=0;
                }
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

    $(".hloc").hover(function(){
        $("#hintloc").show();
    },function(){ 
        $("#hintloc").hide();
    });

    $(".htitle").hover(function(){
        $("#hinttitle").show();
    },function(){ 
        $("#hinttitle").hide();
    });

    $(".himg").hover(function(){
        $("#hintimg").show();
    },function(){ 
        $("#hintimg").hide();
    });


});