<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone - HTML Admin Template" class="w-6" src="{{asset('dashboards/dist/images/logo.svg')}}">
        </a>
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        <ul class="scrollable__content py-2">
            <li>
                <a href="/home" class="menu menu--active">
                    <div class="menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="menu__title"> Dashboard <i class="menu__sub-icon transform rotate-180"></i> </div>
                </a>
            </li>
            <li>
                <a href="/siswa" class="menu menu--active">
                    <div class="menu__icon"> <i data-lucide="user"></i> </div>
                    <div class="menu__title"> Siswa <i class="menu__sub-icon transform rotate-180"></i> </div>
                </a>
            </li>
            <li>
                <a href="/guru" class="menu menu--active">
                    <div class="menu__icon"> <i data-lucide="users"></i> </div>
                    <div class="menu__title"> Guru <i class="menu__sub-icon transform rotate-180"></i> </div>
                </a>
            </li>
            <li>
                <a href="javascript:;.html" class="menu menu--active">
                    <div class="menu__icon"> <i data-lucide="message-square"></i> </div>
                    <div class="menu__title"> Pelanggaran <i data-lucide="chevron-down" class="menu__sub-icon transform rotate-180"></i> </div>
                </a>
                <ul class="menu__sub-open">
                    <li>
                        <a href="/pelanggaran" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="message-square"></i> </div>
                            <div class="menu__title"> Pelanggaran </div>
                        </a>
                    </li>
                    <li>
                        <a href="/ketpelanggaran" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="menu__title"> Kategori Pelanggaran </div>
                        </a>
                    </li>
                </ul>   
            </li>

            
     
          <li>
                <a href="javascript:;.html" class="menu menu--active">
                    <div class="menu__icon"> <i data-lucide="award"></i> </div>
                    <div class="menu__title"> Penghargaan <i data-lucide="chevron-down" class="menu__sub-icon transform rotate-180"></i> </div>
                </a>
                <ul class="menu__sub-open">
                    <li>
                        <a href="/penghargaan" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="award"></i> </div>
                            <div class="menu__title"> Penghargaan </div>
                        </a>
                    </li>
                    <li>
                        <a href="/ketpenghargaan" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="file-text"></i> </div>
                            <div class="menu__title"> Kategori Penghargaan </div>
                        </a>
                    </li>
                </ul> 
            </li>

        <li>
            <a href="javascript:;.html" class="menu menu--active">
                <div class="menu__icon"> <i data-lucide="trello"></i> </div>
                <div class="menu__title"> Penanganan <i data-lucide="chevron-down" class="menu__sub-icon transform rotate-180"></i> </div>
            </a>
            <ul class="menu__sub-open">
                <li>
                    <a href="/penanganan" class="menu menu--active">
                        <div class="menu__icon"> <i data-lucide="trello"></i> </div>
                        <div class="menu__title"> Penanganan </div>
                    </a>
                </li>
                <li>
                    <a href="/ketpenanganan" class="menu menu--active">
                        <div class="menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="menu__title"> Kategori Penanganan </div>
                    </a>
                </li>
        </li>
    </ul> 
    </div>
</div>