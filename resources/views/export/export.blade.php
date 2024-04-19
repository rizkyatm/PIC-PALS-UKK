<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Aktivitas</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Aktivitas</th>
                <th>tess</th>
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
