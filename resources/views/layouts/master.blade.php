<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Товары</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
{{View::make('layouts.header')}}
@yield('content')
{{View::make('layouts.footer')}}

</body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    .navbar {
        background-color: darkslateblue;
        height: 60px;
        font-size: 1.8em;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    .navbar-brand {
        color: #fff;
        font-weight: bold;
        margin-right: 20px;
    }

    .navbar-nav .nav-link {
        color: #fff;
        font-weight: bold;
        margin-right: 20px;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link:focus {
        color: #f8f8f8;
    }

    .navbar-default .navbar-nav .nav-link.active {
        color: #333;
        font-weight: bold;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link:focus {
        background-color: #333;
        color: #f2f2f2;
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .col-md-1 {
        flex: 0 0 8.333333%;
        max-width: 8.333333%;
    }

    .col-md-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    input[type="file"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-size: 14px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        grid-gap: 20px;
    }

    .card {
        user-select: none;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: border-color 0.3s;
    }

    .card:hover {
        border-color: #000000;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }

    .card-text {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
        text-align: center;
    }

    .card-text.price {
        color: green;
        text-align: center;
    }

    .card-text.discount {
        color: red;
        text-align: center;
    }

    .custom-card-body {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
</html>
