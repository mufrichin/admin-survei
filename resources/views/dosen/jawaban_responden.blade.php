@extends('layouts.app_admin')

@section('content')    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Jawaban Responden - Dosen</h3>
  </div>
</div>
<!-- End Page Header -->

<!-- Top Referrals Component -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card card-small">
      <div class="card-header border-bottom">
        <h6 class="m-0">
          {{ $responden['nama'] or "Si Tanpa Nama" }}
          <small class="text-muted d-block">NIP: {{ $responden['nip'] or "-" }}</small>
        </h6>
      </div>
      <div class="card-body pt-0">
        <div class="row py-4">
          <div class="col-sm-4 col-md-2">
            <ul class="list-group mb-4">
              @php $num = 0; @endphp
              @foreach($kategori_pertanyaan as $nama_kategori => $kategori)
                <a href="#kategori_{{ $num }}" class="list-group-item list-group-item-info">{{ $nama_kategori }}</a>
                @php $num++; @endphp
              @endforeach
            </ul>
          </div>
          <div class="col-sm-8 col-md-10">
            {{-- {{ print("<pre>".print_r($list_jawaban, true)."</pre>") }} --}}
              @php $num = 0; @endphp
              @foreach($kategori_pertanyaan as $nama_kategori => $kategori)
                <h6 id="kategori_{{ $num }}" class="border-bottom text-info">{{ $nama_kategori }}</h6>
                <ol>
                  @foreach($kategori as $item)
                  <li>
                    <strong class="d-block mb-2">{{ $list_jawaban[$item]->pertanyaan }}</strong>
                    <p class="text-muted">
                      @if(strtolower($nama_kategori) == "kepuasan")
                        {{ $opsi_kepuasan[$list_jawaban[$item]->value] or '-' }}
                      @else 
                        {{ $list_jawaban[$item]->value or '-' }}
                      @endif
                    </p>
                  </li>
                  @endforeach
                </ol>
                @php $num++; @endphp
              @endforeach
              {{-- @foreach($list_jawaban as $row)
              <li>
                <strong class="d-block mb-2">{{$row->pertanyaan}}</strong>
                <p class="text-muted">{{$row->value or '-'}}</p>
              </li>
              @endforeach --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Top Referrals Component -->

@endsection


@push("style")

@endpush

@section('pagespecificjs') 
<script>
  $(document).ready(function() {
    
  }); //End Document Ready
</script>
@endsection