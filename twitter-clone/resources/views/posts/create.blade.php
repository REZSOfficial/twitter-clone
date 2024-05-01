@extends('layouts.app')

@section('content')
<div class="container text-light rounded border border-2 border-info">
    <div class="row justify-content-center">

        <form method="POST" action="{{ route('savePost') }}" enctype="multipart/form-data"
            class="d-flex flex-column align-items-center justify-content-center">
            @csrf

            <div class="row justify-content-center w-75 my-3">
                <textarea rows="4" id="text" type="text"
                    class="post-input text-info bg-dark border border-info fw-bold @error('text') border-danger is-invalid @enderror"
                    name="text" value="{{ old('text') }}" autocomplete="text" autofocus></textarea>

                @error('text')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>

            <div class="row justify-content-center w-75 my-3">
                <img class="mb-3 p-2 bg-custom-dark rounded hidden" src="" id="image-preview" style="width: 30vw">
                <label class="d-flex justify-content-center w-100" id="add-img-label" for="image-input"><i
                        class="fa-solid fa-camera text-info fs-2"></i></label>
                <input rows="4" id="image-input" accept="image/*" type="file" class="@error('img') is-invalid @enderror"
                    name="img" value="{{ old('img') }}" autocomplete="img">



                @error('img')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row justify-content-center h-100 mb-2">
                <button type="submit" class="btn btn-dark border-info">
                    {{ __('Tweet') }}
                </button>
            </div>
        </form>

    </div>
    @endsection