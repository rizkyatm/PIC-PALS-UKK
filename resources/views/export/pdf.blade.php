<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas User</title>
</head>
<body>
    <h1 style="text-align: center">Laporan Aktivitas {{$user->username}}</h1>
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
                    <td style="max-width: 335px">{{ $data->aktivitas }}</td>
                    <td>
                        @if ($data->foto)
                            @php
                                $imagePath = Storage::url($data->foto);
                                $imageData = base64_encode(file_get_contents(public_path($imagePath)));
                                $imageSrc = 'data:' . mime_content_type(public_path($imagePath)) . ';base64,' . $imageData;
                            @endphp
                            <img style="max-width: 150px; max-height: 400px;" src="{{ $imageSrc }}" alt="Foto">
                        @else
                            <p>------</p>
                        @endif
                    </td>
                    <td style="max-width: 250px">{{ $data->created_at->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
            
        
        </tbody>
    </table>
</body>
</html>

