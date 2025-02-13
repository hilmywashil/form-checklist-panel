<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Form Item Pemeriksaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('formitems.store') }}" method="POST">
                            @csrf

                            <!-- ITEM PEMERIKSAAN -->
                            <div class="form-group">
                                <label class="font-weight-bold">ITEM PEMERIKSAAN</label>
                                <input type="text"
                                    class="form-control @error('item_pemeriksaan') is-invalid @enderror"
                                    name="item_pemeriksaan" value="{{ old('item_pemeriksaan') }}"
                                    placeholder="Masukkan Item Pemeriksaan">

                                @error('item_pemeriksaan')
                                    <div class="alert alert-danger mt-2">
                                        Item Pemeriksaan tidak boleh kosong!
                                    </div>
                                @enderror
                            </div>

                            {{-- <!-- CHECK (NORMAL / PERBAIKAN) -->
                            <div class="form-group">
                                <label class="font-weight-bold">STATUS CHECK</label><br>
                                <input type="radio" name="check" value="normal" checked> Normal
                                <input type="radio" name="check" value="perbaikan"> Perbaikan

                                @error('check')
                                    <div class="alert alert-danger mt-2">
                                        Pilih salah satu status check!
                                    </div>
                                @enderror
                            </div> --}}

                            <!-- KETERANGAN -->
                            <div class="form-group">
                                <label class="font-weight-bold">KETERANGAN (Opsional)</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="3"
                                    placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>

                                @error('keterangan')
                                    <div class="alert alert-danger mt-2">
                                        Keterangan tidak boleh kosong!
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">PANEL</label>
                                <select name="panel_id" class="form-control @error('panel_id') is-invalid @enderror">
                                    <option value="">Pilih Panel</option>
                                    @foreach ($panels as $panel)
                                        <option value="{{ $panel->id }}"
                                            {{ isset($panel_id) && $panel_id == $panel->id ? 'selected' : '' }}>
                                            {{ $panel->nama_panel }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('panel_id')
                                    <div class="alert alert-danger mt-2">
                                        Pilih salah satu panel!
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
