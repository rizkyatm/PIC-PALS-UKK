<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas User</title>
</head>
<body>
    <h1>Aktivitas User</h1>
    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Aktivitas</th>
                <th>Foto</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aktivitas as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->aktivitas }}</td>
                <td>{{ $data->foto }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
