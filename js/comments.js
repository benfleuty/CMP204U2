class comment {
    constructor(text, username, id, datetime) {
        this.id = id;
        this.username = username;
        this.text = text;
        this.datetime = datetime;
    }

    create() {
        return `<div id="commentId-${this.id}" class="comment-outer">
        <div class="comment-body"><p>${this.text}</p></div>
        <hr class="comment-hr"><div class="comment-footer">
        <div class="comment-user-details"><p>${this.username} ${this.datetime}
        <span class="comment-user-controls"><i id="edit-${this.id}" class="fa fa-edit"></i>
        <i id="delete-${this.id}" class="fa fa-trash" aria-hidden="true"></i></span></div></div></div>`;
    }

    editor(text,id){
        return `<div id="commentId-${id}" class="comment-outer">
        <div class="comment-body">
            <label for="commentText" content="Edit your comment:">
                    <textarea id="commentTextEditor" aria-multiline="true" maxlength="140" placeholder="You cannot have an empty comment!" required
                              form="commentEditorForm">${text}</textarea>
            </label>
        </div>
        <hr class="comment-hr">
        <div class="comment-footer">
            <button id="postCommentEditButton" class="bg-primary text-white" type="submit" form="commentEditorForm">Save
            </button>
            <form id="commentEditorForm"></form>
        </div>
    </div>`;
    }

}

function getClickedId(sender){
    return sender.target.id.split('-')[1];
}

$(document).ready(function () {
    $(document).on("submit", "form", function (e) {
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
    $(document).on("click", ".fa-trash", function (e) {
        commentID = getClickedId(e);
        $("#confirm-delete").modal();
    });

    $(document).on("click","#deleteComment", function () {
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

    var editing = false;

    $(document).on("click",".fa-edit",function (e){
        if(editing){

            return;
        }
        editing = true;
        commentID = getClickedId(e);
        let search = "#commentId-"+commentID;
        let toChange = $(search);
        let toChangeText = $(search + " > div > ").html().trim();
        let temp = new comment();
         $(toChange).replaceWith(temp.editor(toChangeText,commentID));
    });

    $(document).on("click","#postCommentEditButton",function (){
        let textToEnter = $("#commentTextEditor").val();
        console.info(`text to enter: ${textToEnter} - ${typeof (textToEnter)}`);
        console.info(`commentID: ${commentID}`);
        $.ajax({
            url: "editComment.php",
            method: "POST",
            data: {id: commentID, content: textToEnter},
            dataType: "json",
            success: function (data) {
                if (data[0] === "success") {
                    let username = data[1];
                    let datetime = data[2];
                    let Comment = new comment(textToEnter, username, commentID, datetime);

                    let search = "#commentId-"+commentID;
                    let toReplace = $(search);
                    $(toReplace).replaceWith(Comment.create());
                    return;
                } else if (data[0] === "not logged in") data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> You must be logged in to comment!</div>`;
                else data = `<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> Your comment could not be posted!</div>`;
                $("#loginFormMessage").html(data);
            }
        });
    });
});