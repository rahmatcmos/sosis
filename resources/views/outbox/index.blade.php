@extends('_layouts.dashboard')

@section('content')
<h1 class="page-header">Kotak Keluar <small>SOSIS</small></h1>

<div class="row">
    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-sort"></span> 
                Urutkan
            </button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('outbox.index') }}?sort=UpdatedInDB&mode={{ $mode }}&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Tanggal</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-sort-by-alphabet"></span> 
                Mode
            </button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('outbox.index') }}?sort={{ $sort }}&mode=asc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Asc</a></li>
                <li><a href="{{ route('outbox.index') }}?sort={{ $sort }}&mode=desc&cari={{ $cari }}&cari_bulan={{ $cari_bulan }}">Desc</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-2">
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-export"></span> Ekspor</button>
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" target="_blank">PDF</a></li>
            </ul>
        </div>
    </div>

    <div class="col-md-1">
        <button type="button" class="btn btn-danger btn-sm">
            <span class="glyphicon glyphicon-ban-circle"></span> 
            Batalkan
        </button>
    </div>

    <div class="col-md-5">
        <form class="form-inline pull-right" action="{{ route('outbox.index') }}" method="get">
            <div class="form-group">
                <input type="text" class="form-control input-sm" id="search" name="cari" placeholder="Pencarian..." value="{{ $cari }}">
                <input type="text" class="form-control input-sm datepicker-month" id="cari_bulan" name="cari_bulan" placeholder="Bulan" value="{{ $cari_bulan }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="mode" value="{{ $mode }}">
            </div>
            <button type="submit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-search"></span>
                Cari
            </button>
        </form>
    </div>
</div><br>

<div class="table">
    <table class="table table-striped table-hover table-condensed">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="15%">Tanggal</th>
                <th width="10%">Tujuan</th>
                <th width="65%">Isi Pesan</th>
                <th width="5%">Pilihan</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = $outbox_all->firstItem() ?>
            @forelse($outbox_all as $outbox)
            <tr>
                <td>{{ $nomor++ }}.</td>
                <td>
                    <small>{{ $outbox->UpdatedInDB }}</small>
                    <br>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($outbox->UpdatedInDB)->diffForHumans() }}</small>
                </td>
                <td>
                    {{ $outbox->DestinationNumber }}
                    <br>
                    <small>Contact Name</small>
                </td>
                <td>{{ $outbox->TextDecoded }}</td>
                <td>
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href=""><span class="glyphicon glyphicon-eye-open"></span> Lengkap</a></li>
                            <li class="divider"></li>
                            <li><a href=""><span class="glyphicon glyphicon-ban-circle"></span> Batalkan</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">
                    <p>Tidak ada pesan yang dapat ditampilkan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {!! $outbox_all->appends(compact('sort', 'mode', 'cari', 'cari_bulan'))->render() !!}
    <p>
        Menampilkan {{ $outbox_all->count() }} dari total {{ $outbox_all->total() }} pesan <br>
        <small class="text-muted">dengan urutan berdasarkan {{ $sort }} ({{ $mode }}) untuk kata kunci '{{{ $cari }}}'</small>
    </p>
</div>


@stop