<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Survei Kepuasan - Satuan Penjamin Mutu - Universitas Negeri Malang</title>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="{!! asset('css/shards-dashboards.1.0.0.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('css/extras.1.0.0.min.css')!!}">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css">

    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.sidr/2.2.1/stylesheets/jquery.sidr.dark.min.css">

    {{-- Select 2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    {{-- Custom css untuk patching style dari plugin --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

    <style>
.menu {
    display: inline-block;
    cursor: pointer;
}

.bar1, .bar2, .bar3 {
    width: 35px;
    height: 5px;
    background-color: #007bff;
    margin: 6px 15px;
    transition: 0.4s;
}

.change .bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-9px, 6px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
    -webkit-transform: rotate(45deg) translate(-8px, -8px);
    transform: rotate(45deg) translate(-8px, -8px);
}
</style>

    <style type="text/css">
    .center{
        margin: auto;
    }        

    </style>
    @stack("style")
</head>
<body>


    <div class="main-content-container container-fluid px-4">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4 mb-5">
          <div class="col-12 text-center text-sm-center mb-0">
            <a href="{{url('/')}}">
                <img src="{{asset('images/um_logo_blue_text.png')}}" width="240">
            </a>
            <br>
            <span class="text-uppercase page-subtitle">Satuan Penjaminan Mutu - Universitas Negeri Malang</span>
            <h3 class="page-title">Sistem Survei Kepuasan</h3>

        </div>

    </div>
    <!-- <div class="row" style="margin-bottom:60px">
        &nbsp;
        <div class="col-4 offset-md-4">
            <select class="form-control" name="tahun">
                @for($tahun=date("Y"); $tahun>=2015; $tahun--)
                <option value="{{ $tahun }}" @if(null != session("tahun")) @if(session("tahun") == $tahun) selected="" @endif @endif>{{ $tahun }}</option>
                @endfor
            </select>
        </div>
    </div> -->
    @if(null != session("userID"))
    <div class="row" style="margin-bottom:60px;">
        <div class="col-12">
        <div class="alert alert-info fade show mb-0" role="alert">
            <span>
                Hay, <strong>{{ session("userID") }}</strong>. Anda mengakses sebagai 
                @if(session("tipe") == 1)
                <strong>Mahasiswa</strong>.
                @elseif(session("tipe") == 2)
                <strong>Dosen</strong>.
                @elseif(session("tipe") == 3)
                <strong>Tendik</strong>.
                @endif
            </span>
            
            <span class="float-right">
                
            <a class="btn btn-warning" href="{{ url("/logout") }}">
                Logout
                <i class="fas fa-sign-out-alt"></i>
            </a>
            </span>
            <span class="clearfix"></span>
        </div>
        </div>
    </div>
    @endif
    @if(null != session("msg"))
    <div class="row" style="margin-bottom:60px;">
        <div class="col-12">
        <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            {{ session("msg") }}
        </div>
        </div>
    </div>
    @endif

@yield('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 text-center text-sm-center mb-0">
        <h3 class="page-title">#dukungmutuUM</h3>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script> --}}
<script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
{{-- <script src="{!! asset('js/extras.1.0.0.min.js')!!}"></script> --}}
{{-- <script src="{!! asset('js/shards-dashboards.1.0.0.min.js')!!}"></script> --}}
{{-- <script src="{!! asset('js/app/app-blog-overview.1.0.0.js')!!}"></script> --}}
{{-- <script src="{!! asset('js/app/app-blog-new-post.1.0.0.js')!!}"></script> --}}
{{-- <script src="{!! asset('js/app/app-components-overview.1.0.0.js')!!}"></script> --}}
<script src="{{ asset('js/textareacounter.js') }}"></script>
<script src="//cdn.jsdelivr.net/jquery/2.2.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("select[name='tahun']").change(function(){
            var tahun = $(this).val();
            window.location.href = "{{ url("/ubah-tahun") }}/"+tahun;
        });
    });
</script>

<script>
function myFunction(x) {
    x.classList.toggle("change");
}
</script>

<script>
$(document).ready(function() {
  $('#simple-menu').sidr();
});
</script>

@yield('pagespecificjs')


@stack("reportjs")
@stack("highchart")
</body>
</html>