function cnfEdit() {
    return confirm("Do you really want to Edit it");
}
function logout() {
    return confirm("Do you really want to Logout");
}

$(document).ready(function () {
    $("#hintpost").hide();

    $(".hpost").hover(function () {
        $("#hintpost").show();
    }, function () {
        $("#hintpost").hide();
    });
});