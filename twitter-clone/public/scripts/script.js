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

    $("#confirmDeleteBtn").click(function () {
        $("#deleteForm").submit();
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
                $("#post-like-icon" + postId).removeClass("fa-solid");
                $("#post-like-icon" + postId).removeClass("text-danger");
            } else {
                $("#post-like" + postId).html(likeCount + 1);
                $("#post-like-icon" + postId).addClass("fa-solid");
                $("#post-like-icon" + postId).addClass("text-danger");
            }
        },
        error: function (xhr, status, error) {},
    });

    event.stopPropagation();
}

function comment(postId, userId, userName) {
    event.preventDefault();

    let data = {
        post_id: postId,
        user_id: userId,
        text: $("#comment-text-" + postId).val(),
    };

    let commentCount = $("#post-comment" + postId).text();
    commentCount = parseInt(commentCount);

    $.ajax({
        type: "POST",
        url: "/api/posts/comment/" + postId,
        data: data,
        success: function (response) {
            $("#comments-" + postId).append(
                '<hr class="text-light"><div class="mb-2 p-2 rounded"><div class="fw-bold text-info">' +
                    userName +
                    "</div><div>" +
                    data.text +
                    "</div></div>"
            );
            $("#comment-text-" + postId).val("");
            $("#post-comment" + postId).html(commentCount + 1);
        },
        error: function (xhr, status, error) {
            $("#comment-text-" + postId).addClass("border-danger");
        },
    });
}

function setListener(userId, receiverId) {
    $("#message-input").on("keydown", function (event) {
        if (event.keyCode === 13) {
            sendMessage(userId, receiverId);
        }
    });
}

function showMessages(userId, senderId) {
    hideMessage();
    if (!$("#message-" + userId).hasClass("opened")) {
        $.ajax({
            url: "/api/messages/show",
            type: "GET",
            data: { user_id: userId, sender_id: senderId },
            success: function (response) {
                $("#messages-container").append(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            },
        });
    }
}

function hideMessage() {
    $("#messages-container").empty();
}

function sendMessage(userId, receiverId) {
    let message = $("#message-input").val();
    $("#message-input").val("");
    $.ajax({
        url: "/api/messages/send",
        type: "POST",
        data: { sender_id: userId, receiver_id: receiverId, message: message },
        success: function (response) {
            $("#sent-message-" + receiverId).append(
                "<div class='d-flex w-100 justify-content-end'><li class='fs-6 bg-dark border border-info text-info rounded p-2 mt-2'>" +
                    message +
                    "</li></div>"
            );
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        },
    });
}

function convertToInputField(element) {
    let inputValue = $(element).text();
    let userId = $(element).attr("id");

    let inputElement = $("<input>", {
        type: "text",
        value: inputValue,
        class: "fs-1 text-info rounded bg-dark",
        css: {
            height: $(element).outerHeight(),
        },
    });

    inputElement.css({
        width: $(element).outerWidth(),
        transition: "width 0s ease-in-out",
    });

    $(element).replaceWith(inputElement);
    inputElement.animate(
        {
            width: inputElement.get(0).scrollWidth + 50,
        },
        300
    );
    inputElement.focus();

    inputElement.on("keydown", function (event) {
        if (event.keyCode === 13) {
            updateUsername(userId, inputElement.val());
            revertToOriginalElement(
                userId,
                inputElement,
                $(inputElement).val()
            );
        }
    });

    inputElement.on("blur", function () {
        revertToOriginalElement(userId, inputElement, $(element).text());
    });
}

function revertToOriginalElement(userId, inputElement, value) {
    let originalText = value;

    let originalElement = $("<h1>", {
        id: userId,
        text: originalText,
        class: "text-info",
    });

    originalElement.css({
        width: $(inputElement).outerWidth(),
        transition: "width 0s ease-in-out",
    });

    inputElement.replaceWith(originalElement);

    originalElement.animate(
        {
            width: originalElement.get(0).scrollWidth - 50,
        },
        300
    );

    originalElement.on("click", function () {
        convertToInputField(originalElement);
    });
}

function updateUsername(userId, newUsername) {
    $.ajax({
        method: "POST",
        url: "/api/user/update",
        data: {
            id: userId,
            username: newUsername,
        },
        success: function (response) {
            showToast(response.message, "success");
            $(".username-container").each(function () {
                $(this).text("@" + newUsername);
            });
            $("#navbarDropdown").text("@" + newUsername);
        },
        error: function (error) {
            showToast("Something went wrong", "error");
        },
    });
}

function showToast(message, result) {
    $("#custom-toast").remove();
    let toast;
    if (result === "error") {
        toast = $(
            "<p id='custom-toast' class='bg-danger text-light p-2 rounded'></p>"
        );
    } else {
        toast = $(
            "<p id='custom-toast' class='bg-success text-light p-2 rounded'></p>"
        );
    }

    toast.text(message);

    $("#toastContainer").append(toast);
    toast.css("opacity", 0);

    toast.animate({ opacity: 1 }, 300);

    setTimeout(function () {
        toast.animate({ opacity: 0 }, 300);
    }, 5000);
    setTimeout(function () {
        toast.remove();
    }, 5300);
}

function closeNotification() {
    $("#profile-notification").remove();
}
