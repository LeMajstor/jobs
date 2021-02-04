<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('admin/images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/images/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Procurar" aria-label="Procurar">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('organization.form') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Cadastrar Empresa
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('painel/organization/form/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('painel/organization/form/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Empresas
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{ $organizations->count() }}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @foreach($organizations as $item)
                        <li class="nav-item">
                            <a href="{{ route('organization.form', ['url' => $item->url]) }}" 
                                class="nav-link @if(isset($organization)) {{ $organization->url == $item->url ? 'active' : '' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ $item->name }}</p>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('offer.form') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Cadastrar vaga
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('painel/candidate/list/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('painel/candidate/list/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Vagas
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">{{ $offers->count() }}</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @foreach($offers as $item)
                        <li class="nav-item">
                            <a href="{{ route('candidate.offer', ['url' => $item->url]) }}" 
                                class="nav-link @if(isset($offer)) {{ $offer->url == $item->url ? 'active' : '' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ $item->title }}</p>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
