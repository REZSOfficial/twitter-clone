<div class="row justify-content-center modal modal-lg fade" id="change-profile-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card bg-custom-dark text-light shadow h-100">
            <div class="card-header">Upload a picture!</div>
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="container w-100 text-light rounded border border-2 border-info">
                    <div class="row justify-content-center">

                        <form method="POST" action="{{route('updateProfilePicture', ['id' => Auth::user()->id])}}"
                            enctype="multipart/form-data"
                            class="d-flex flex-column align-items-center justify-content-center">
                            @csrf

                            <div class="row justify-content-center w-75 my-3">
                                <img class="mb-3 p-2 bg-custom-dark rounded hidden" src="" id="image-preview"
                                    style="width: 30vw">
                                <label class="d-flex justify-content-center w-100" id="add-img-label"
                                    for="image-input"><i class="fa-solid fa-camera text-info fs-2"></i></label>
                                <input rows="4" id="image-input" accept="image/*" type="file"
                                    class="@error('profilepicture') is-invalid @enderror" name="profilepicture"
                                    value="{{ old('profilepicture') }}" autocomplete="img">

                                @error('profilepicture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row justify-content-center h-100 mb-2">
                                <button type="submit" class="btn btn-dark border-info">
                                    {{ __('Change') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>