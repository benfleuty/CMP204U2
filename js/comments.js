class comment {
    constructor(text, username, id, datetime) {
        this.id = id;
        this.username = username;
        this.text = text;
        this.datetime = datetime;
    }

    create() {
        let output = `<div id="commentId-${this.id}" class="comment-outer">`;
        output = `${output}<div class="comment-body"><p>${this.text}</p></div>`;
        output = `${output}<hr class="comment-hr"><div class="comment-footer">`;
        output = `${output}<div class="comment-user-details"><p>${this.username} ${this.datetime}`;
        output = `${output}<span class="comment-user-controls"><i class="fa fa-edit"></i><i id="${this.id}" class="fa fa-trash delete-comment" aria-hidden="true"></i></span></div></div></div>`;
        return output;
    }

}

function deleteComment(id) {
    $.ajax({
        url: "deleteComment.php",
        method: "POST",
        data: {id: id},
        success: function (data) {
            $("#confirm-delete").modal("hide");
            if (data === "success") {
                console.info(`trying to delete #commentId-${id}`);
                let search = `#commentId-${id}`;
                console.info(`search = ${search}`);
                $(search).fadeOut(300, function () {
                    console.info(`$(search).remove();`)
                    $(search).remove();
                })
            }
        }
    });
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
            dataType: "json",
            success: function (data) {
                console.info(`response: ${data}`);
                if (data[0] === "success") {
                    let username = data[1];
                    let id = data[2];
                    let datetime = data[3];
                    // add user's comment to top of comments
                    let Comment = new comment(text, username, id, datetime);
                    let commentsOutput = $("#comments-output");
                    let current = commentsOutput.html();
                    let newCommentsHTML = `${Comment.create()}${current}`;

                    commentsOutput.html(newCommentsHTML);
                    $("#noCommentsMessage").remove();
                    $("#commentText").innerText = "";
                    return;
                } else if (data[0] === "not logged in") data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> You must be logged in to comment!</div>`;
                else data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> Your comment could not be posted!</div>`;
                $("#loginFormMessage").html(data);
            }
        });
    });

    var commentID;
    $(document).on("click", ".delete-comment", function () {
        commentID = this.id;
        $("#confirm-delete").modal();
    });

    $(document).on("click","#deleteComment", function () {
        console.info(`deleting id ${commentID}`)
        $.ajax({
            url: "deleteComment.php",
            method: "POST",
            data: {id: commentID},
            success: function (data) {
                $("#confirm-delete").modal("hide");
                if (data === "success") {
                    console.info(`trying to delete #commentId-${commentID}`);
                    let search = `#commentId-${commentID}`;
                    console.info(`search = ${search}`);
                    $(search).fadeOut(300, function () {
                        console.info(`$(search).remove();`)
                        $(search).remove();
                    })
                }
            }
        });
    });
});