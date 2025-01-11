<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>C2</title>
</head>

<body>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row[0] }}</td>
                <td>{{ $row[1] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>

</html>