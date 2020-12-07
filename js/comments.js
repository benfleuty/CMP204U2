$(document).ready(function () {
    $("#commentForm").submit(function (e){
        e.preventDefault();
    });

    $("#postCommentButton").click(function () {
        let comment = $("#commentText").val();
        if (comment === "") return;






    });
});