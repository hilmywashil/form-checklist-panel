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
    <p><strong>Nama Pekerjaan:</strong> {{ $formpanel->nama_pekerjaan }}</p>
    <p><strong>Nomor SPK:</strong> {{ $formpanel->nomor_spk }}</p>
    <p><strong>Tanggal SPK:</strong> {{ $formpanel->tanggal_spk }}</p>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Item Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formitems as $index => $fi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $fi->item_pemeriksaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>