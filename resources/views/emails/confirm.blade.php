@extends('email')

@section('content')
    <h1>Welcome, {{ $name }}!</h1>
    <p class="lead">Please confirm your registration!</p>
    <p>
        We'd love to send you notifications about your lunch-dates - but we won't do it, unless you confirm your e-mail address.
    </p>

    <br>

    <table class="button facebook">
        <tbody><tr>
            <td>
                <a href="#">I am me!</a>
            </td>
        </tr>
        </tbody>
    </table>

    <br>
    <br>
@endsection
