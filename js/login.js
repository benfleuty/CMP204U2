function logIn(username, password) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // login here
            let response = this.responseText;
            if (response === "success")
                location.reload();
            else {
                let data = "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>  <strong>Error!</strong> Your username/password combination did not match any records!</div>";
                $("#loginFormMessage").html(data);
            }
        }
    }

    xhttp.open("POST", "login.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`username=${username}&password=${password}&login=true`);
}


$(document).ready(function () {
    $("#loginButton").click(function (e) {
        e.preventDefault();
        let username = $('#loginUsername').val();
        let password = $('#loginPassword').val();
        let data = "";
        let errors = false;
        if (username === "") {
            data = "<div class=\"alert alert-danger alert-dismissible fade show m-1\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><span class=\"sr-only\" > Close</span ><strong>Error:</strong> Please enter your username.</div>";
            $("#loginUsernameMsg").html(data);
            errors = true;
        } else $("#loginUsernameMsg").html("");
        if (password === "") {
            data = "<div class=\"alert alert-danger alert-dismissible fade show m-1\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><span class=\"sr-only\" > Close</span ><strong>Error:</strong> Please enter your password.</div>";
            $("#loginPasswordMsg").html(data);
            errors = true;
        } else $("#loginPasswordMsg").html("");

        if (errors) return;
        logIn(username, password);
    });
})