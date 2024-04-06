$(document).ready(function () {
    $("#image-input").change(function () {
        let input = this;
        let imagePreview = $("#image-preview")[0]; // Get DOM element

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            $("#image-preview").removeClass("hidden");
            reader.readAsDataURL(input.files[0]); // Read and load the image file
        }
    });
});
