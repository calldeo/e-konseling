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
    <head>
        @include('template.header')
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
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 2xl:col-span-9">
                            <div class="grid grid-cols-12 gap-6">
                                <!-- BEGIN: General Report -->
                                <div class="col-span-12 mt-8">
                                    <div class="intro-y flex items-center h-10">
                                        <h2 class="text-lg font-medium truncate mr-5">
                                            Dashboard
                                        </h2>
                                        <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                                    </div>

                           <!-- BEGIN: Top 10 Siswa Pelanggaran -->
                                <div class="col-span-12 mt-5">
                                    <div class="intro-y flex items-center h-10">
                                        <h2 class="text-lg font-medium truncate mr-5">
                                            Top 10 Siswa Pelanggaran Terbanyak
                                        </h2>
                                    </div>
                                    <div class="grid grid-cols-12 gap-6 mt-5">
                                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                            <div class="report-box zoom-in">
                                                <div class="box p-5">
                                                    <div class="flex items-center">
                                                        <i data-lucide="message-square" class="report-box__icon text-primary"></i> 
                                                        <div class="ml-auto">
                                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="Total Pelanggaran"> {{$siswaPelanggaran->sum('total_pelanggaran')}} </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-base font-medium leading-2 mt-1">
                                                        <a href="javascript:;" class="toggle-siswa-pelanggaran">Lihat Siswa</a>
                                                    </div>
                                                    <div class="text-base text-slate-500 mt-5">Pelanggaran</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 siswa-pelanggaran hidden">
                                            @foreach ($siswaPelanggaran as $siswa)
                                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                                <div class="report-box zoom-in small">
                                                    <div class="box p-3">
                                                        <div class="text-base font-medium leading-2 mt-1">{{$siswa->nama}}</div>
                                                        <div class="text-base text-slate-500 mt-1">Total Pelanggaran: {{$siswa->total_pelanggaran}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div> 
                                <!-- END: Top 10 Siswa Pelanggaran -->
                                <div class="col-span-12 mt-5">
                                    <div class="intro-y flex items-center h-10">
                                        <h2 class="text-lg font-medium truncate mr-5">
                                            Top 10 Siswa Penghargaan Terbanyak
                                        </h2>
                                    </div>
                                    <div class="grid grid-cols-12 gap-6 mt-5">
                                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                            <div class="report-box zoom-in">
                                                <div class="box p-5">
                                                    <div class="flex">
                                                        <i data-lucide="award" class="report-box__icon text-primary"></i> 
                                                        <div class="ml-auto">
                                                            <div class="report-box__indicator bg-primary tooltip cursor-pointer" title="Total Penghargaan"> {{$siswaPenghargaan->sum('total_penghargaan')}} </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-base font-medium leading-2 mt-1">
                                                        <a href="javascript:;" class="toggle-siswa-penghargaan">Lihat Siswa</a>
                                                    </div>
                                                    <div class="text-base text-slate-500 mt-5">Penghargaan</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 siswa-penghargaan hidden">
                                            @foreach ($siswaPenghargaan as $siswa)
                                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                                <div class="report-box zoom-in small">
                                                    <div class="box p-3">
                                                        <div class="text-base font-medium leading-2 mt-1">{{$siswa->nama}}</div>
                                                        <div class="text-base text-slate-500 mt-1">Total Penghargaan: {{$siswa->total_penghargaan}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                    </div>
                                </div>
                                <!-- END: General Report -->
                                <!-- BEGIN: Sales Report -->

                                <!-- END: Sales Report -->
                                <!-- BEGIN: Weekly Top Seller -->

                                <!-- END: Weekly Top Seller -->
                                <!-- BEGIN: Sales Report -->

                                <!-- END: Sales Report -->
                                <!-- BEGIN: Official Store -->

                                <!-- END: Official Store -->
                                <!-- BEGIN: Weekly Best Sellers -->

                                <!-- END: Weekly Best Sellers -->
                                <!-- BEGIN: General Report -->

                                <!-- END: General Report -->
                                <!-- BEGIN: Weekly Top Products -->

                                <!-- END: Weekly Top Products -->
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END: Content -->
            </div>
        </div>
        <!-- BEGIN: Dark Mode Switcher-->

        <!-- END: Dark Mode Switcher-->

        <!-- BEGIN: JS Assets-->
        @include('template.scricpt')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleSiswaPelanggaran = document.querySelector('.toggle-siswa-pelanggaran');
                const siswaPelanggaran = document.querySelector('.siswa-pelanggaran');
        
                toggleSiswaPelanggaran.addEventListener('click', function() {
                    siswaPelanggaran.classList.toggle('hidden');
                });
            });
              document.addEventListener('DOMContentLoaded', function() {
                const toggleSiswaPenghargaan = document.querySelector('.toggle-siswa-penghargaan');
                const siswaPenghargaan = document.querySelector('.siswa-penghargaan');
        
                toggleSiswaPenghargaan.addEventListener('click', function() {
                    siswaPenghargaan.classList.toggle('hidden');
                });
            });
        </script>
         {{-- <script>
          
        </script> --}}
        <!-- END: JS Assets-->
    </body>
</html>
