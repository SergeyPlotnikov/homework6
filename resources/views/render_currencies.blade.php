<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Currencies</title>
</head>
<body>
<div class="content">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>short name</th>
            <th>actual course</th>
            <th>actual course date</th>
            <th>active</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currencies as $currency)
            <tr>
                <td> {{$currency->getId()}} </td>
                <td> {{$currency->getName()}} </td>
                <td> {{$currency->getShortName()}} </td>
                <td> {{$currency->getActualCourse()}} </td>
                <td> {{$currency->getActualCourseDate()->format('Y-m-d H:i:s') }} </td>
                <td> {{$currency->isActive()?1:0}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>