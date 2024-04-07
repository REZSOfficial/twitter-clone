$(document).ready(function () {
    $("#image-input").change(function () {
        let input = this;
        let imagePreview = $("#image-preview")[0];

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            $("#image-preview").removeClass("hidden");
            reader.readAsDataURL(input.files[0]);
        }
    });
});

function like(postId, userId) {
    event.preventDefault();

    let isLiked = $("#post-like-icon" + postId).hasClass("text-danger");
    let likeCount = $("#post-like" + postId).text();
    likeCount = parseInt(likeCount);
    let data = {
        post_id: postId,
        user_id: userId,
    };
    $.ajax({
        type: isLiked ? "DELETE" : "POST",
        url: isLiked
            ? "/api/posts/removelike/" + postId
            : "/api/posts/like/" + postId,
        data: data,
        success: function (response) {
            if (isLiked) {
                $("#post-like" + postId).html(likeCount - 1);
                $("#post-like-icon" + postId).removeClass("text-danger");
            } else {
                $("#post-like" + postId).html(likeCount + 1);
                $("#post-like-icon" + postId).addClass("text-danger");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.error(error);
        },
    });
}
