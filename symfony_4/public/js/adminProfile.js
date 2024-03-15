function alldel(){
    return confirm("Warning: Do you really want to Delete all the data.");
}
function logout(){
    return confirm("Do you really want to Logout");
}
function mulDel(){
    return confirm("Do you really want to Delete it");
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.check').each(function(){
                this.checked=true;
            });
        }
        else{
            $('.check').each(function(){
                this.checked=false;
            });
        }
    });
});