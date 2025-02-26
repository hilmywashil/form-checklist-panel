@extends('formpanels.layoutForUser.app')

@section('title', 'Form Checklist Panel')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="text-center">FORM CHECKLIST PANEL</h3>
                        <br>

                        <div class="row">
                            <!-- Informasi panel di kiri -->
                            <div class="col-md-9">
                                <p><strong>Nama Panel:</strong> {!! $formpanel->nama_panel !!}</p>
                                <p><strong>Lokasi:</strong> {!! $formpanel->lokasi !!}</p>
                                <p><strong>Tanggal:</strong> {!! $formpanel->tanggal !!}</p>
                                <p><strong>Teknisi:</strong> {!! $formpanel->teknisi !!}</p>
                            </div>

                            <!-- QR Code di kanan -->
                            <div class="col-md-3 text-center">
                                <img id="qrCode" src="{{ asset('storage/qrcodes/panel_' . $formpanel->id . '.png') }}"
                                    alt="QR Code" class="w-100 auto">
                                <br />
                                <a id="downloadQR" href="{{ asset('storage/qrcodes/panel_' . $formpanel->id . '.png') }}"
                                    download="{{ $formpanel->nama_panel }}.png">
                                    <br>
                                    <i class="fas fa-download"></i> Download kode QR
                                </a>
                            </div>
                        </div>

                        <hr>

                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ITEM PEMERIKSAAN</th>
                                    <th scope="col">KONDISI</th>
                                    <th scope="col">KETERANGAN</th>
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
                        <a href="{{ route('formpanels.pdf', $formpanel->id) }}" class="btn btn-md btn-primary mb-3 ">
                            <i class="fas fa-file-pdf"></i> DOWNLOAD PDF
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
