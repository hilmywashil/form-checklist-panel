@extends('formpanels.layoutForUser.app')

@section('title', 'Form Checklist Panel')

@section('content')
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
                                <th scope="col">KONDISI</th>
                                <th scope="col">KETERANGAN</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($formitems as $fi)
                                <tr>
                                    <td>{{ $fi->item_pemeriksaan }}</td>
                                    <td>
                                        @if ($fi->check == 'normal')
                                            <span class="text-success"><i class="fas fa-check-circle"></i>
                                                Kondisi Normal</span>
                                        @elseif ($fi->check == 'perbaikan')
                                            <span class="text-danger"><i class="fas fa-times-circle"></i>
                                                Butuh Perbaikan</span>
                                        @else
                                            <span class="text-secondary"><i class="fas fa-times-circle"></i>
                                                Kondisi belum dicek</span>
                                        @endif
                                    </td>
                                    <td>{!! $fi->keterangan ?? 'Tidak ada Keterangan' !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('formitems.edit', $fi->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> EDIT
                                        </a>
                                        <form action="{{ route('formitems.destroy', $fi->id) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> HAPUS
                                            </button>
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
                    <a href="{{ url('/formpanels') }}" class="btn btn-md btn-danger mb-3">
                        <i class="fas fa-arrow-left"></i> BACK
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
