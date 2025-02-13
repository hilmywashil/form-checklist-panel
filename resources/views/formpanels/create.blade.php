<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Form Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('formpanels.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA PANEL</label>
                                <input type="text" class="form-control @error('nama_panel') is-invalid @enderror"
                                    name="nama_panel" value="{{ old('nama_panel') }}" placeholder="Masukkan Nama Panel">

                                @error('nama_panel')
                                    <div class="alert alert-danger mt-2">
                                        Nama Panel tidak boleh kosong!
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">LOKASI</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    name="lokasi" value="{{ old('lokasi') }}" placeholder="Masukkan Lokasi">

                                @error('lokasi')
                                    <div class="alert alert-danger mt-2">
                                        Lokasi tidak boleh kosong!
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal') }}">

                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        Tanggal tidak boleh kosong!
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">TEKNISI</label>
                                <input type="text" class="form-control @error('teknisi') is-invalid @enderror"
                                    name="teknisi" value="{{ old('teknisi') }}" placeholder="Masukkan Nama Teknisi">

                                @error('teknisi')
                                    <div class="alert alert-danger mt-2">
                                        Nama teknisi tidak boleh kosong!
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
