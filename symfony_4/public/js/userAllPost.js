// let val=0;
// function cnfView(){
//   IconView();
// }



function IconView(){
    var value=$("#tg").val();
    if(value==1){
    var display = $('#popup').css('display');
    // alert(val);
    if (display === "none") {
        $('#popup').show();
        $('#overlay').fadeIn();
    }
    else {
        $('#popup').hide();
        $('#overlay').fadeOut();
        document.getElementById("tg").innerHTML="0";
    }
}
};

$('#overlay').click(() => {
    $('#popup').hide();
    $('#overlay').fadeOut();
});



window.onload = IconView