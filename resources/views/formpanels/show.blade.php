<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Checklist Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-20">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="text-center">FORM CHECKLIST PANEL</h3>
                        <br>
                        <p><strong>Nama Panel:</strong> {!! $formpanel->nama_panel !!}</p>
                        <p><strong>Lokasi:</strong> {!! $formpanel->lokasi !!}</p>
                        <p><strong>Tanggal:</strong> {!! $formpanel->tanggal !!}</p>
                        <p><strong>Teknisi:</strong> {!! $formpanel->teknisi !!}</p>

                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ITEM PEMERIKSAAN</th>
                                    <th scope="col">CHECK</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formitems as $fi)
                                    <tr>
                                        <td>{{ $fi->item_pemeriksaan }}</td>
                                        <td>
                                            <form action="{{ route('updateCheck', $fi->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <input type="radio" name="check" value="normal"
                                                    {{ $fi->check == 'normal' ? 'checked' : '' }}> Normal
                                                <input type="radio" name="check" value="perbaikan"
                                                    {{ $fi->check == 'perbaikan' ? 'checked' : '' }}> Perbaikan

                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                            </form>
                                        </td>
                                        <td>{!! $fi->keterangan ?? 'Tidak ada Keterangan' !!}</td>
                                        <td class="text-center">
                                            <a href="{{ route('formitems.edit', $fi->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            <form action="{{ route('formitems.destroy', $fi->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data Form Item belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $formitems->links() }}
                        <a href="{{ '/formpanels' }}" class="btn btn-md btn-danger mb-3">BACK</a>
                        <a href="{{ route('formitems.create', ['panel_id' => $formpanel->id]) }}"
                            class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>

</html>
