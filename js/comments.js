class comment {
    constructor(text, username, id, datetime) {
        this.id = id;
        this.username = username;
        this.text = text;
        this.datetime = datetime;
    }

    create() {
        let output = `<div class="comment-outer"><div class="comment-body"><p>`;
        output = `${output}${this.text}`;
        output = `${output}</p></div><hr class="comment-hr"><div class="comment-footer"><div class="comment-user-details"><p>`;
        output = `${output}${this.username} at ${this.datetime}`;
        output = `${output}</p></div><div class="comment-user-controls"><i class="fa fa-edit"></i><i class="fa fa-trash" aria-hidden="true"></i></div></div></div>`;
        return output;
    }

}

$(document).ready(function () {
    $("#commentForm").submit(function (e) {
        e.preventDefault();
    });

    $("#postCommentButton").click(function () {
        let text = $("#commentText").val();
        if (text === "") return;
        console.info(`#commentText.val() = ${text}`);
        $.ajax({
            url: "postComment.php",
            method: "POST",
            data: {comment: text},
            dataType:"json",
            success: function (data) {
                console.info("AJAX Success");
                console.info(`data typeof = ${typeof (data)}`);
                console.info(`data length = ${data.length}`);
                console.info(`data = ${data}`);
                if (data[0] === "success") {
                    console.info(`data[0] === "success"`);
                    let username = data[1];
                    let id = data[2];
                    let datetime = data[3];
                    // add user's comment to top of comments
                    let Comment = new comment(text, username, id, datetime);
                    let current = $("#comments-output").html();
                    console.info(`current = ${current}`);

                    let newCommentsHTML = `${Comment.create()}${current}`;

                    $("#comments-output").html(newCommentsHTML);
                    $(".no-comments-message").remove();
                    return;
                } else if (data[0] === "not logged in") data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> You must be logged in to comment!</div>`;
                else data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> Your comment could not be posted!</div>`;
                $("#loginFormMessage").html(data);
            }
        });
    });
});