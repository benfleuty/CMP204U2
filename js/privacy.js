$(document).ready(function () {
    $(document).on("click", "#delete-account", function () {
        console.info("click");
        let delAcc = confirm("Your account will be deleted!");
        if (!delAcc) return;
        console.info("delacc: " + delAcc);
        $.ajax({
            url: "deleteAccount.php",
            method: "POST",
            success: function (data) {
                console.info("data: " + data);
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
})