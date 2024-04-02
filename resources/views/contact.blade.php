@extends('layouts/main')

@section('title', 'Contact')

@section('content')

@if (session('success')) <!-- Display a success message if the form was successfully submitted -->
    <div class="alert alert-success">
        <p style="color: green; font-style: italic; font-size: 18px;">{{ session('success') }}</p>
    </div>
@endif
@if ($errors->has('captcha'))
<p style="color: red; font-style: italic; font-size: 18px;">{{ $errors->first('captcha') }}</p>
@endif
<style>
    .subtitle {
        display: block;
    }

    textarea {
        width: 80%; /* Set the width of the message textarea to 80% */
    }
    .btn { /* Style the submit button */
        background-color: #f5f5f5;
        color: #363636;
        border: 1px solid #363636;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #a5a5a5;
        color: #000000;
    }

    .box { /* Style the boxes. used for comments, input fields, textareas */
        border: 1px solid #f5f5f5;
        padding: 10px;
        margin-bottom: 20px;
    }
    .box:hover {
        border: 1px solid #363636;
    }

    .textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .textarea:hover {
        border: 1px solid #363636;
    }

</style>
<h1 class="mt-2 mb-4 is-size-1 is-size-3-mobile has-text-weight-bold">Contact</h1>
<br>
<form method="POST" action="/contact">
    @csrf

    <div> <!-- Name input field -->
        <label for="name" class="subtitle has-text-grey">Nom</label>
        <input type="text" name="name" id="name" class="form-control box" value="{{ old('name') }}" required>
    </div>
    <br>
    <div> <!-- Email input field -->
        <label for="email" class="subtitle has-text-grey">Email</label>
        <input type="email" name="email" id="email" class="form-control box" value="{{ old('email') }}" required>
    </div>
    <br>
    <div> <!-- Message textarea -->
        <label for="message" class="subtitle has-text-grey">Comment pouvons-nous vous aider?</label>
        <textarea name="message" id="message" class="form-control textarea box" required rows="5">{{ old('message') }}</textarea>
    </div>
    <br>

    <div> <!-- Captcha image and input field -->
        <label for="captcha" class="subtitle has-text-grey">Captcha</label>
        <p>{!! captcha_img() !!}</p>
        <input type="text" name="captcha" id="captcha" class="form-control box" required>
    </div>
    <br> <!-- Submit button -->
    <button type="submit" class="btn btn-primary subtitle has-text-grey rounded">Submit</button>
</form>
@endsection
