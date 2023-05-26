
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
    <title>Penghargaan - Si Beka</title>
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
                        Data Penghargaan
                    </h2>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                            {{-- <button  class="btn btn-primary shadow-md mr-2" href="/tambah_siswa">Add</button> --}}
                            <div class="dropdown">
                                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                                </button>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="/tambah_phg" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Tambah Penghargaan </a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="hidden md:block mx-auto text-slate-500"></div>
                            <form action="" class="form-inline" method="GET">
                                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                    
                                    <div class="w-56 relative text-slate-500">
                                        <input type="search" name="keyword" class="form-control w-56 box pr-10" placeholder="Search...">
                                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- BEGIN: Data List -->
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="text-center whitespace-nowrap">No</th>
                                        <th class="text-center whitespace-nowrap">Nama Siswa</th>
                                        <th class="text-center whitespace-nowrap">Nama Penghargaan</th>
                                        <th class="text-center whitespace-nowrap">Nama Guru</th>
                                        <th class="text-center whitespace-nowrap">Point</th>
                                        <th class="text-center whitespace-nowrap">Catatan</th>        
                                        <th class="text-center whitespace-nowrap">Waktu</th>                                 
                                        
                                        {{-- <th class="text-center whitespace-nowrap">Username</th> --}}
                                        {{-- <th class="text-center whitespace-nowrap">Password</th> --}}

                                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $da)
                                    <td  class="text-center">{{$da->id_penghargaan}}</td>
                                    <td class="text-center">{{$da->siswa?->nama}}</td>
                                    <td  class="text-center">{{$da->ketpenghargaan->kategori_penghargaan}}</td>
                                    <td class="text-center">{{$da->user?->name}}</td>
                                    <td class="text-center">{{$da->point}}</td>
                                    <td class="text-center">{{$da->catatan}}</td>
                                    <td class="text-center">{{$da->waktu}}</td>

                                    
                                    {{-- <td class="text-center">{{$g->password}}</td> --}}

                                    <td class="table-report__action w-40">
                                        <div class="flex justify-center items-center">
                                            <a class="btn btn-primary" href="/penghargaan/{{ $da->id_penghargaan }}/edit_penghargaan" >
                                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                            </a>
                                            
                                            <form action="{{ route('penghargaan.destroy1', $da->id_penghargaan) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#delete-confirmation-modal-{{ $da->id_penghargaan }}">
                                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                                 
                            
                            </table>
                            <div class="my-5 ">
                                {{$data ->links() }}
                            </div>
                        </div>
                        <!-- END: Data List -->
                        <!-- BEGIN: Pagination -->
                        
                        <!-- END: Pagination -->
                    </div>
                    <!-- BEGIN: Delete Confirmation Modal --> 
                    @foreach($data as $ket1)
                    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="p-5 text-center">
                                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                        <div class="text-3xl mt-5">Are you sure?</div>
                                        <div class="text-slate-500 mt-2">
                                            Do you really want to delete these records? 
                                            <br>
                                            This process cannot be undone.
                                        </div>
                                    </div>
                                    <div class="px-5 pb-8 text-center">
                                        <form action="/penghargaan/{{ $ket1->id_penghargaan }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                            <button type="submit"  class="btn btn-danger w-24" >Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <!-- END: Delete Confirmation Modal -->
                </div>
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