<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Harian - {{ $panel->nama_panel }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2>Laporan Harian {{ $tanggal }}</h2>
    <p><strong>Status:</strong> {{ $panelStatus }}</p>

    <p><strong>Nama Panel:</strong> {{ $panel->nama_panel }}</p>
    <p><strong>Lokasi:</strong> {{ $panel->lokasiRel->nama_lokasi }}</p>
    <p><strong>Pekerjaan:</strong> {{ $panel->nama_pekerjaan ?? '-' }}</p>
    <p><strong>Nomor SPK:</strong> {{ $panel->nomor_spk ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Kondisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($panel->formitems as $item)
                @php
                    $dailyItem = $dailyChecklist
                        ? $dailyChecklist->items->firstWhere('form_checklist_item_id', $item->id)
                        : null;
                @endphp
                <tr>
                    <td>{{ $item->item_pemeriksaan }}</td>
                    <td>{{ $dailyItem ? ucfirst($dailyItem->kondisi) : 'Belum diperiksa' }}</td>
                    <td>{{ $dailyItem && $dailyItem->keterangan ? $dailyItem->keterangan : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
