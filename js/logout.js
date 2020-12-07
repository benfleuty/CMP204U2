$(document).ready(function () {
    $("#logoutButton").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "logout.php",
            method: "POST",
            success: function () {
                location.reload();
            }
        });
    });
})