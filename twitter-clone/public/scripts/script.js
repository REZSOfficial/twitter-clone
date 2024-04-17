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
                $("#post-like-icon" + postId).removeClass("fa-solid");
                $("#post-like-icon" + postId).removeClass("text-danger");
            } else {
                $("#post-like" + postId).html(likeCount + 1);
                $("#post-like-icon" + postId).addClass("fa-solid");
                $("#post-like-icon" + postId).addClass("text-danger");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.error(error);
        },
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
    console.log(receiverId);
    $.ajax({
        url: "/api/messages/send",
        type: "POST",
        data: { sender_id: userId, receiver_id: receiverId, message: message },
        success: function (response) {
            $("#sent-message-" + receiverId).append(
                "<p class='fs-6 bg-dark border border-info text-info rounded p-2'>" +
                    message +
                    "</p>"
            );
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        },
    });
}
/*
$(document).ready(function () {
    let originalElement = $("#username");

    originalElement.on("click", function () {
        convertToInputField(id, originalElement);
    });
});
*/
function convertToInputField(id, element) {
    console.log(id);
    let inputValue = element.textContent; // Get text content of the original element
    console.log(inputValue);

    // Create a new input element (using raw DOM element)
    let inputElement = document.createElement("input");
    inputElement.type = "text";
    inputElement.value = inputValue;
    inputElement.className =
        "border border-dark border-1 fs-1 text-info rounded bg-dark w-25 h-100";

    // Replace the original element with the new input element
    element.parentNode.replaceChild(inputElement, element);

    // Focus on the input field after replacing
    inputElement.focus();

    inputElement.addEventListener("keydown", function (event) {
        if (event.keyCode === 13) {
            // Check if Enter key is pressed
            updateUsername(id, inputElement.value); // Call function to update username
        }
    });

    // Add blur event handler to revert back to original element
    inputElement.addEventListener("blur", function () {
        revertToOriginalElement(id, inputElement, inputValue);
    });
}

function revertToOriginalElement(id, inputElement, inputValue) {
    console.log(inputValue);
    let originalText = inputElement.value; // Get the value entered in the input field
    console.log("orig:" + originalText);
    let originalElement = document.createElement("h1");
    originalElement.type = "text";
    originalElement.innerHTML = originalText;
    originalElement.className = "text-info";
    originalElement.id = "username";

    // Replace the input element with the original div element
    inputElement.replaceWith(id, originalElement);

    // Reattach click event handler to convert back to input
    originalElement.addEventListener("click", function () {
        convertToInputField(id, originalElement);
    });
}

function updateUsername(id, newUsername) {
    // Make an AJAX request to update the username
    $.ajax({
        method: "POST", // Use PUT method to update the resource
        url: "/api/user/update", // URL of your API endpoint
        data: {
            username: newUsername,
            id: id,
        },
        success: function (response) {
            // Handle success response
            console.log("Username updated successfully!");
        },
        error: function (error) {
            // Handle error response
            console.error("Error updating username:", error);
        },
    });
}
