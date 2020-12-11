$(document).ready(function () {
    $(document).on("click", "#delete-account", function () {
        let delAcc = confirm("Your account will be deleted!");
        if (!delAcc) return;
        $("#delete-account").click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "deleteAccount.php",
                method: "POST",
                success: function (data) {
                    if (data === "success") {
                        alert("Your account was deleted");
                        $.ajax({
                            url: "logout.php",
                            method: "POST",
                            success: function () {
                                location.replace("index.php");
                            }
                        });
                    } else if (data === "guest")
                        alert("You are not logged in!");
                    else alert("There was an error. Your account was not deleted!");
                }
            });
        });
    });
})