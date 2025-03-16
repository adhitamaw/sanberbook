@extends('layouts.master')

@section('title')
    register
@endsection('title')

@section('content')
    <h1>Buat Account Baru!</h1>
    <h2>Sign Up Form</h2>

    <form action="{{ url('/welcome') }}" method="post">
        @csrf
        <label for="firstname">First name:</label><br>
        <input type="text" id="firstname" name="firstname"><br><br>

        <label for="lastname">Last name:</label><br>
        <input type="text" id="lastname" name="lastname"><br><br>

        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="gender" value="Other">
        <label for="other">Other</label><br><br>

        <label for="nationality">Nationality:</label><br>
        <select id="nationality" name="nationality">
            <option value="Indonesian">Indonesian</option>
            <option value="Malaysian">Malaysian</option>
            <option value="Singaporean">Singaporean</option>
            <option value="Australian">Australian</option>
            <option value="Japanese">Japanese</option>
            <option value="Korean">South Korean</option>
            <option value="American">American</option>
            <option value="German">German</option>
        </select><br><br>

        <label>Language Spoken:</label><br>
        <input type="checkbox" id="bahasa" name="language" value="Bahasa Indonesia">
        <label for="bahasa">Bahasa Indonesia</label><br>
        <input type="checkbox" id="english" name="language" value="English">
        <label for="english">English</label><br>
        <input type="checkbox" id="otherlang" name="language" value="Other">
        <label for="otherlang">Other</label><br><br>

        <label for="bio">Bio:</label><br>
        <textarea id="bio" name="bio" rows="10" cols="30"></textarea><br><br>

        <input type="submit" value="Sign Up">
    </form>
@endsection('content')