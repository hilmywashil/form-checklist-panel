<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        .baik {
            background-color: #4ade80;
            color: white;
        }

        .tidak-baik {
            background-color: #ef4444;
            color: white;
        }

        .kosong {
            background-color: #d1d5db;
        }
    </style>
</head>

<body>
    <h2>Pemeliharaan Bulanan - {{ $bulan }}/{{ $tahun }}</h2>
    <h4>Panel: {{ $panel->nama_panel }}</h4>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Item Pemeriksaan</th>
                <th colspan="31">Tanggal</th>
            </tr>
            <tr>
                @for ($i = 1; $i <= 31; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td style="text-align: left">{{ $item->item_pemeriksaan }}</td>
                    @for ($i = 1; $i <= 31; $i++)
                        @php
                            $tanggal = sprintf('%s-%02d-%02d', $tahun, $bulan, $i);
                            $dailyItem = optional(optional($checklists[$tanggal] ?? null)->items)->firstWhere(
                                'form_checklist_item_id',
                                $item->id,
                            );
                            $kondisi = $dailyItem->kondisi ?? null;
                        @endphp
                        <td
                            class="
                            {{ $kondisi === 'baik' ? 'baik' : ($kondisi ? 'tidak-baik' : 'kosong') }}
                        ">
                            {{ $kondisi ? ($kondisi === 'baik' ? 'B' : 'TB') : '-' }}
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
