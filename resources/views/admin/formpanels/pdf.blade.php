<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Checklist Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Form {{ $formpanel->nama_panel }}</h2>
    <p><strong>Lokasi:</strong> {{ $formpanel->lokasi }}</p>
    <p><strong>Tanggal:</strong> {{ $formpanel->tanggal }}</p>
    <p><strong>Teknisi:</strong> {{ $formpanel->teknisi }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item Pemeriksaan</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formitems as $index => $fi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $fi->item_pemeriksaan }}</td>
                    <td>{{ ucfirst($fi->check) ?? 'Belum dicek' }}</td>
                    <td>{{ $fi->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
