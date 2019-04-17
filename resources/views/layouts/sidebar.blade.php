<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ">
    <!-- Brand Logo -->
    <a href="https://www.puce.edu.ec" class="brand-link">
        <img src="/images/logo-puce.png" class="brand-image img-circle elevation-3"
             style="opacity: 1 ">
        <span class="brand-text font-weight-light" style="color:#45bfde">PUCE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if(!empty(Auth::user()))
                <div class="image">
                    <img src="/uploads/avatars/{{Auth::user()->avatar}}"
                         class="img-circle elevation-2" alt="User Image">

                </div>
            @endif
            <div class="info">@if(!empty(Auth::user()))
                    <a href="{{ URL::to('users/' . Auth::user()->id) }}"
                       class="d-block">{{  Auth::user()->name}}</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(!empty(Auth::user()))
                    @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item has-treeview ">
                            <a href="/sedes" class="nav-link ">
                                <i class="nav-icon fa fa-university"></i>
                                <p>
                                    Sedes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="/facultades" class="nav-link ">
                                <i class="nav-icon fa fa-archway"></i>
                                <p>
                                    Facultades
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="/escuelas" class="nav-link ">
                                <i class="nav-icon fa fa-school"></i>
                                <p>
                                    Escuelas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="/carreras" class="nav-link ">
                                <i class="nav-icon fa fa-stethoscope"></i>
                                <p>
                                    Carreras
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="/coordinadores" class="nav-link">
                                <i class="nav-icon fa fa-clipboard"></i>
                                <p>
                                    Coordinadores
                                </p>
                            </a>

                        </li>
                    @endif

                    @if(!Auth::user()->hasRole('tut'))
                    <li class="nav-item has-treeview">
                        <a href="/empresas" class="nav-link">
                            <i class="nav-icon fa fa-building"></i>
                            <p>
                                Empresas
                            </p>
                        </a>

                    </li>
                        @endif
                    @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item has-treeview">
                            <a href="/tutores" class="nav-link">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>
                                    Tutores Empresariales
                                </p>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('coord') )
                        <li class="nav-item has-treeview">
                            <a href="/profesores" class="nav-link">
                                <i class="nav-icon fa fa-chalkboard-teacher"></i>
                                <p>
                                    Profesores
                                </p>
                            </a>

                        </li>
                    @endif
                    @if(!(Auth::user()->hasRole('est')))
                        <li class="nav-item has-treeview">
                            <a href="/estudiantes" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Estudiantes
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item has-treeview">
                        <a href="/practicas" class="nav-link">
                            <i class="nav-icon fa fa-book-open"></i>
                            <p>
                                Practicas
                            </p>
                        </a>
                    </li>
                    @if(!Auth::user()->hasRole('tut'))
                        <li class="nav-item has-treeview">
                            <a href="/formatos" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>
                                    Formatos
                                </p>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->hasRole('coord')or Auth::user()->hasRole('prof') or Auth::user()->hasRole('est'))
                        <li class="nav-item has-treeview">
                            <a href="/reportes" class="nav-link">
                                <i class="nav-icon fa fa-pie-chart"></i>
                                <p>Reportes
                                </p>
                            </a>
                        </li>
                    @endif
            </ul>

            @endif

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>