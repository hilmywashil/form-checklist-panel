<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<style>
    th,
    td {
        text-align: center
    }
</style>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h1 class="text-center my-4">DAFTAR FORM PANEL</h1>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('formpanels.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PANEL</a>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NAMA PANEL</th>
                                    <th scope="col">LOKASI</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">TEKNISI</th>
                                    <th scope="col">PREVIEW</th>
                                    <th scope="col">ADMIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formpanels as $fp)
                                    <tr>
                                        <td>{{ $fp->nama_panel }}</td>
                                        <td>{!! $fp->lokasi !!}</td>
                                        <td>{!! $fp->tanggal !!}</td>
                                        <td>{!! $fp->teknisi !!}</td>
                                        <td> <a href="{{ route('formpanels.show', $fp->id) }}"
                                                class="btn btn-sm btn-dark">DATA <strong>{{$fp->nama_panel}}</strong></a>
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('formpanels.destroy', $fp->id) }}" method="POST">
                                                <a href="{{ route('formpanels.edit', $fp->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Form Panel belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $formpanels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>

</body>

</html>
