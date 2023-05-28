
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
    <title>Guru - Si Beka</title>
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
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                    <h2 class="intro-y text-lg font-medium mt-10">
                        Data Guru
                    </h2>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                            {{-- <button  class="btn btn-primary shadow-md mr-2" href="/tambah_guru">Add</button> --}}
                            <div class="dropdown">
                                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                                </button>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="/tambah_ketpng" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Tambah Guru </a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                <div class="w-56 relative text-slate-500">
                                    <input type="search" class="form-control w-56 box pr-10" placeholder="Search...">
                                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                                </div>
                            </div>
                        </div>
                        <!-- BEGIN: Data List -->
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="text-center whitespace-nowrap">No</th>
                                        <th class="text-center whitespace-nowrap">Nama Penanganan</th>
                                        <th class="text-center whitespace-nowrap">catatan</th>
                                        {{-- <th class="text-center whitespace-nowrap">Point</th> --}}
                                        {{-- <th class="text-center whitespace-nowrap">Username</th> --}}
                                        {{-- <th class="text-center whitespace-nowrap">Password</th> --}}

                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($ketpenanganan as $kp)
                                 {{-- <tr onclick="window.location.href = '/ketpelanggaran/{{ $kp->id_kategori_pelanggaran }}/edit_ketpelanggaran'" class="cursor-pointer"> --}}
                                        <td  class="text-center">{{$kp->id_kategori_penanganan}}</td>
                                        <td  class="text-center">{{$kp->nama_kategori_penanganan}}</td>
                                        <td class="text-center">{{$kp->catatan}}</td>
                                        {{-- <td class="text-center">{{$kp->point}}</td> --}}
                                        {{-- <td class="text-center">{{$g->password}}</td> --}}

                                        <td class="table-report__action w-40">
                                            <div class="flex justify-center items-center">
                                                <a class="btn btn-primary" href="/ketpenanganan/{{ $kp->id_kategori_penanganan }}/edit_ketpenanganan" >
                                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                                </a>
                                                
                                                <form action="{{ route('ketpenanganan.destroy', $kp->id_kategori_penanganan) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#delete-confirmation-modal-{{ $kp->id_kategori_penanganan}}">
                                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END: Data List -->
                        <!-- BEGIN: Pagination -->
                       
                        <!-- END: Pagination -->
                    </div>
                    <!-- BEGIN: Delete Confirmation Modal -->
              
                <!-- END: Content -->
            </div>
                <!-- END: Content -->
            </div>
        </div>
        <!-- BEGIN: Dark Mode Switcher-->
        
        <!-- END: Dark Mode Switcher-->
        
        <!-- BEGIN: JS Assets-->
        @include('template.scricpt')
        @include('sweetalert::alert')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteForms = document.querySelectorAll('.delete-form');
                var confirmationModal = document.getElementById('delete-confirmation-modal');
                
                deleteForms.forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        var result = confirm('Are you sure you want to delete this record?');
                        if (result) {
                            form.submit();
                        }
                    });
                });
            });
        </script>

        <!-- END: JS Assets-->
    </body>
</html>