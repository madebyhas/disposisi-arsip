view:
@foreach($disposisi->catatan as $catatan)
    <p><strong>{{ $catatan->pegawai->nama_pegawai }}</strong>: {{ $catatan->catatan }}</p>
@endforeach
