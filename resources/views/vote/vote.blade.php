<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.headerr')
    <title>E-vote | {{auth()->user()->level}} | Vote </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
            background: #fff;
            margin-bottom: 30px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        .welcome-text {
            animation: fadeInLeft 1s ease;
        }
        .new-arrivals-img-contnent img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .new-arrivals-img-contnent img:hover {
            transform: scale(1.02);
        }
        .new-arrival-content h4 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 15px 0;
        }
        .new-arrival-content p {
            color: #666;
            margin: 8px 0;
        }
        .new-arrival-content .text-content {
            font-style: italic;
            color: #888;
            border-left: 3px solid #EB8153;
            padding-left: 15px;
            margin: 15px 0;
        }
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .modal-header {
            background: linear-gradient(45deg, #EB8153, #ff9b72);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 20px 30px;
        }
        .modal-body {
            padding: 30px;
        }
        .btn {
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-success {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
        }
        .btn-secondary {
            background: linear-gradient(45deg, #6c757d, #495057);
            border: none;
        }
        .alert {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    @include('template.topbarr')
    @include('template.sidebarr')

    <div class="content-body animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="row page-titles mx-0 mb-4">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Selamat Datang!</h4>
                        <p class="mb-0">Silakan pilih calon OSIS pilihanmu</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Vote</li>
                    </ol>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span><i class="fas fa-times"></i></span>
                </button>
            </div>
            @endif

            @if(session('update_success'))
            <div class="alert alert-warning alert-dismissible fade show">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('update_success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span><i class="fas fa-times"></i></span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-times-circle mr-2"></i>
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span><i class="fas fa-times"></i></span>
                </button>
            </div>
            @endif

            <div class="row">
                @foreach($calonOsis as $calon)
                <div class="col-lg-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="new-arrivals-img-contnent">
                                        <img src="{{ asset('foto_calon/' . $calon->gambar) }}" 
                                             alt="{{ $calon->nama_calon }}" 
                                             data-toggle="modal" 
                                             data-target="#myModal{{ $calon->id }}"
                                             class="shadow">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="new-arrival-content">
                                        <h4>
                                            <span class="badge badge-primary mr-2">No. {{ $calon->id }}</span>
                                            {{ $calon->nama_calon }}
                                        </h4>
                                        <p><i class="fas fa-calendar-alt mr-2"></i> <strong>Periode:</strong> {{ $calon->periode }}</p>
                                        <p><i class="fas fa-id-card mr-2"></i> <strong>NIS:</strong> {{ $calon->NIS }} <i class="fas fa-check-circle text-success ml-1"></i></p>
                                        <p><i class="fas fa-graduation-cap mr-2"></i> <strong>Kelas:</strong> {{ $calon->kelas }}</p>
                                        <p class="text-content">{{ $calon->slogan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade animate__animated animate__fadeIn" id="myModal{{ $calon->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    Detail Calon OSIS - {{ $calon->nama_calon }}
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4 mb-4 mb-md-0">
                                            <img src="{{ asset('foto_calon/' . $calon->gambar) }}" 
                                                 class="img-fluid rounded shadow-sm" 
                                                 alt="{{ $calon->nama_calon }}">
                                            <div class="mt-3">
                                                <h6 class="font-weight-bold">Informasi Calon:</h6>
                                                <p class="mb-1"><i class="fas fa-id-card mr-2"></i>NIS: {{ $calon->NIS }}</p>
                                                <p class="mb-1"><i class="fas fa-graduation-cap mr-2"></i>Kelas: {{ $calon->kelas }}</p>
                                                <p><i class="fas fa-calendar-alt mr-2"></i>Periode: {{ $calon->periode }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-4">
                                                <h6 class="font-weight-bold mb-3">
                                                    <i class="fas fa-bullseye mr-2"></i>Visi
                                                </h6>
                                                <p class="text-muted">{{ $calon->visi }}</p>
                                            </div>
                                            <div class="mb-4">
                                                <h6 class="font-weight-bold mb-3">
                                                    <i class="fas fa-list-ul mr-2"></i>Misi
                                                </h6>
                                                <p class="text-muted">{{ $calon->misi }}</p>
                                            </div>
                                            <div>
                                                <h6 class="font-weight-bold mb-3">
                                                    <i class="fas fa-quote-left mr-2"></i>Slogan
                                                </h6>
                                                <p class="text-muted font-italic">{{ $calon->slogan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('store-vote') }}" method="post" class="mr-2">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="id_calon" value="{{ $calon->id }}">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-vote-yea mr-2"></i>Vote Sekarang
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="fas fa-times mr-2"></i>Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('template.scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function showVoteSuccessToast() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Suara anda telah berhasil tercatat',
                showConfirmButton: false,
                timer: 2000
            });
        }
    
        function showVoteErrorToast() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan. Silakan coba lagi.',
                showConfirmButton: true
            });
        }
    </script>

</body>
</html>