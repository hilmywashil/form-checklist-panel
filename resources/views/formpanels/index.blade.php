@extends('formpanels.layoutForUser.app')

@section('title', 'Daftar Form Panel')

@section('content')
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <!-- Judul -->
            <h2 class="text-center my-4">
                DAFTAR FORM PANEL
            </h2>

            <!-- Form Filter Tanggal -->
            <form action="{{ route('formpanels.index') }}" method="GET" class="mb-4">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="start_date">
                            <i class="fas fa-calendar-alt"></i> Filter Dari Tanggal
                        </label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_date">
                            <i class="fas fa-calendar-alt"></i> Sampai Tanggal
                        </label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="form-group col-md-4 align-self-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('formpanels.index') }}" class="btn btn-secondary">
                            <i class="fas fa-sync"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Tabel -->
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col"> NO</th>
                        <th scope="col"><i class="fas fa-th-list"></i> NAMA PANEL</th>
                        <th scope="col"><i class="fas fa-map-marker-alt"></i> LOKASI</th>
                        <th scope="col"><i class="fas fa-calendar"></i> TANGGAL</th>
                        <th scope="col"><i class="fas fa-user"></i> TEKNISI</th>
                        <th scope="col"><i class="fas fa-eye"></i> PREVIEW</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($formpanels as $index => $fp)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $fp->nama_panel }}</td>
                            <td>{!! $fp->lokasi !!}</td>
                            <td>{!! $fp->tanggal !!}</td>
                            <td>{!! $fp->teknisi !!}</td>
                            <td>
                                <a href="{{ route('formpanels.show', $fp->id) }}" class="btn btn-sm btn-dark">
                                    <i class="fas fa-eye"></i> DETAIL DATA
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-danger m-0">
                                    <i class="fas fa-exclamation-triangle"></i> Data Form Panel belum Tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $formpanels->links() }}

            <a href="{{ url('/') }}" class="btn btn-md btn-danger mt-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Home
            </a>
        </div>
    </div>
@endsection
