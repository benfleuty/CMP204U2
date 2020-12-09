function register(username, password) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // register here
            let response = this.responseText;
            alert(`response:${response}`);

            if (response === "success") {
                location.reload();
            } else if (response === "username taken") {
                let data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> Your username has already been taken!</div>`;
                $("#registerUsernameMsg").html(data);
            } else {
                let data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> Your username/password combination did not match any records!</div>`;
                $("#loginFormMessage").html(data);
            }
        }
    }

    xhttp.open("POST", "register.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`username=${username}&password=${password}&register=true`);
}

$(document).ready(function () {
    $("#registerButton").click(function (e) {
        e.preventDefault();
        let username = $('#registerUsername').val();
        // let fname = $('#registerFname').val();
        // let lname = $('#registerLname').val();
        let password = $('#registerPassword').val();
        let passwordConfirm = $('#registerPasswordConfirm').val();
        let data = "";
        let errors = false;
        if (username === "") {
            data = "<div class=\"alert alert-danger alert-dismissible fade show m-1\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><span class=\"sr-only\" > Close</span ><strong>Error:</strong> Please enter your username.</div>";
            $("#registerUsernameMsg").html(data);
            errors = true;
        } else $("#registerUsernameMsg").html("");
        if (password === "" || passwordConfirm === "") {
            data = "<div class=\"alert alert-danger alert-dismissible fade show m-1\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><span class=\"sr-only\" > Close</span ><strong>Error:</strong> Please enter your password.</div>";
            if (password === "") $("#registerPasswordMsg").html(data);
            else $("#registerPasswordMsg").html("");
            if (passwordConfirm === "") $("#registerPasswordConfirmMsg").html(data);
            else $("#registerPasswordConfirmMsg").html("");
            errors = true;
        }
        if (password !== passwordConfirm) {
            data = "<div class=\"alert alert-danger alert-dismissible fade show m-1\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><span class=\"sr-only\" > Close</span ><strong>Error:</strong> Passwords do not match.</div>";
            $("#registerPasswordMsg").html(data);
            $("#registerPasswordConfirmMsg").html(data);
            errors = true;
        } else {
            data = "";
            $("#registerPasswordMsg").html(data);
            $("#registerPasswordConfirmMsg").html(data);
        }
        if (errors) return;
        register(username, password);
    });
})