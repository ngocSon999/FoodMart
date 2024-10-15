<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
        }
        .main {
            width: 100%;
            height: 100%;
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .table tr,
        .table th,
        .table td
        {
            border: 1px solid;
        }
        .table thead tr {
            background-color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="main">
        <table class="table-primary table">
            <thead>
            <tr>
                <th>Ho va ten</th>
                <th>Tuoi</th>
                <th>Dia chi</th>
                <th>Quyen</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $data['user']['name'] }}</td>
                <td>{{ $data['user']['age'] }}</td>
                <td>{{ $data['user']['address'] }}</td>
                <td>{{ $data['role']['name'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
