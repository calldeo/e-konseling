<!DOCTYPE html>
<!--
Template Name: Icewall - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <meta charset="utf-8">
    <link href="{{asset('dashboards/dist/images/logo.svg')}}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Icewall admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Icewall Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Pelanggaran - Si Beka</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('dashboards/dist/css/app.css')}}" />
    <head>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="main">
        <!-- BEGIN: Mobile Menu -->
        @include('template.mobile')
        <!-- END: Mobile Menu -->

        
        <!-- BEGIN: Top Bar -->
        @include('template.topbar')
        <!-- END: Top Bar -->
        <div class="wrapper">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                @include('template.sidebar')
                <div class="content">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            Tambah Pelanggaran
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Form Layout -->
                            <form action="{{ route('penanganan.store') }}" method="POST">
                                @csrf
                               
                                <div  class="mb-5">
                                    <label for="siswa_id">Siswa</label>
                                    <select name="id_siswa" id="id_siswa" class="form-control">
                                        @foreach($dataSiswa as $siswa)
                                            <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div  class="mb-5">
                                <label for="pelanggaran_id">Pelanggaran:</label>
                                <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                                    @foreach($dataPelanggaran as $pelanggaran)
                                        <option value="{{ $pelanggaran->id }}">{{ $pelanggaran->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div  class="mb-5">
                                    <label for="guru_id">Guru</label>
                                    <select name="id" id="id" class="form-control">
                                        @foreach($dataGuru as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('id')
                                        <p>{{$message}}</p>
                                    @enderror
                                <div class="mb-5">
                                    <label for="status">Status:</label>
                                    <input type="text" name="status" id="status" class="form-control">
                                </div>
                                
                                @error('status')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <div class="mb-5">
                                        <label for="tindak_lanjut">Tindak Lanjut:</label>
                                         <textarea name="tindak_lanjut" id="tindak_lanjut" class="form-control"></textarea>
                                    </div>
                                <div class="mb-5">
                                    <label for="total_point">Total Point:</label>
                                    <input type="text" name="total_point" id="total_point" class="form-control" value="{{ $totalPoint }}" readonly>
                                </div>

                                
                                <button type="submit" name="submit" class="btn btn-info">Simpan</button>
                            
                            </form>
                            <!-- END: Form Layout -->
                        </div>
                    </div>
                </div>
                <!-- END: Content -->
            </div>
            @include('sweetalert::alert')
           
            @include('template.scricpt')
                <script>
                    function getPoint(selectObject) {
                        var data = <?php echo json_encode($pelanggaran)?>;
                        data.forEach(element => {
                            if(element.id_pelanggaran == selectObject.value) {
                                console.log(element);
                                document.getElementById("point").value = element.point;

                            }
                        });
                    }
                </script>
        </div>   
    </html>