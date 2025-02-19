<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Checklist Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 style="text-align: center">FORM CHECKLIST PANEL</h3>
                        <br>
                        <p><strong>Nama Panel: {!! $formpanel->nama_panel !!}</strong></p>
                        <p><strong>Lokasi: {!! $formpanel->lokasi !!}</strong></p>
                        <p><strong>Tanggal: {!! $formpanel->tanggal !!}</strong></p>
                        <p><strong>Teknisi: {!! $formpanel->teknisi !!}</strong></p>
                        <a href="{{ route('formpanels.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
