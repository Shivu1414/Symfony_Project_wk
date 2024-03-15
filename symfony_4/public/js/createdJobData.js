function cnfPublish(){
    return confirm("Do you really want to Publish it");
}
function cnfEdit(){
    return confirm("Do you really want to Update it");
}
function cnfDelete(){
    return confirm("Do you really want to Delete it");
}
function logout(){
    return confirm("Do you really want to Logout");
}
function alldel(){
    return confirm("Warning: Do you really want to Delete all the data.");
}
function mulDel(){
return confirm("Warning: Do you really want to Delete all selected data.");
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked=true;
            });
        }
        else{
            $('.checkbox').each(function(){
                this.checked=false;
            });
        }
    });
});


