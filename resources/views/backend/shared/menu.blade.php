<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
      <b>Bk</b>
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      Back
    </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        {{--  <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success"></span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <img src="{{assets('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Support Team
                      <small>
                        <i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <!-- end message -->
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="{{assets('dist/img/user3-128x128.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      AdminLTE Design Team
                      <small>
                        <i class="fa fa-clock-o"></i> 2 hours</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="{{assets('dist/img/user4-128x128.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Developers
                      <small>
                        <i class="fa fa-clock-o"></i> Today</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="{{assets('dist/img/user3-128x128.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Sales Department
                      <small>
                        <i class="fa fa-clock-o"></i> Yesterday</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <img src="{{assets('dist/img/user4-128x128.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <h4>
                      Reviewers
                      <small>
                        <i class="fa fa-clock-o"></i> 2 days</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer">
              <a href="#">See All Messages</a>
            </li>
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning"></span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-users text-red"></i> 5 new members joined
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-user text-red"></i> You changed your username
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer">
              <a href="#">View all</a>
            </li>
          </ul>
        </li>  --}}
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{assets('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{$user->nome}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{assets('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
              <p>
                {{$user->nome}}
                <small>Cadastrado em {{$user->created_at}}</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                {{--  <a href="#" class="btn btn-default btn-flat">Perfil</a>  --}}
              </div>
              <div class="pull-right">
                <a href="{{route('sair')}}" class="btn btn-default btn-flat">Sair</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
  </nav>
</header>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{assets('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{$user->nome}}</p>
        <a href="#">
          <i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="@if(route::current()->getName() == 'backend.home') active @endif">
        <a href="{{route('backend.home')}}">
          <i class="fa fa-dashboard"></i>
          <span>Painel Inicial</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li class="header">
        <b>SITE</b>
      </li>
      <li class="@if(route::current()->getName() == 'index') active @endif">
        <a href="{{route('index')}}" target="_new">
          <i class="fa fa-sitemap"></i>
          <span>Ver o Site</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li class="header">
        <b>INSTITUCIONAL</b>
      </li>
      <li class="treeview @if(route::current()->getName() == 'backend.banners') active menu-open @endif">
        <a href="#">
          <i class="fa fa-image"></i>
          <span>Banners</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.banners') active @endif">
            <a href="{{route('backend.banners')}}">
              <i class="fa fa-list"></i> Listar Banners</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.home.index'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-home"></i>
          <span>Home</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.home.index') active @endif">
            <a href="{{route('backend.home.index')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(route::current()->getName() == 'backend.depoimentos') active menu-open @endif">
        <a href="#">
          <i class="fa fa-commenting-o"></i>
          <span>Depoimentos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.depoimentos') active @endif">
            <a href="{{route('backend.depoimentos')}}">
              <i class="fa fa-list"></i> Listar Depoimentos</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.sobre-nos'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-info-circle"></i>
          <span>Sobre Nós</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.sobre-nos') active @endif">
            <a href="{{route('backend.sobre-nos')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.como.passos'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-hashtag"></i>
          <span>Como Funciona</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.como.passos') active @endif">
            <a href="{{route('backend.como.passos')}}">
              <i class="fa fa-step-forward"></i> Passos </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.parceiro'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-briefcase"></i>
          <span>Seja Nosso Parceiro</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.parceiro') active @endif">
            <a href="{{route('backend.parceiro')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.dicas','backend.dicas.categorias', 'backend.dicas.pagina'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-lightbulb-o"></i>
          <span>Dicas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.dicas.pagina') active @endif">
            <a href="{{route('backend.dicas.pagina')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
          <li class="@if(Route::current()->getName() == 'backend.dicas.categorias') active @endif">
            <a href="{{route('backend.dicas.categorias')}}">
              <i class="fa fa-th-list"></i> Categorias </a>
          </li>
          <li class="@if(Route::current()->getName() == 'backend.dicas') active @endif">
            <a href="{{route('backend.dicas')}}">
              <i class="fa fa-star"></i> Dicas </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.localizacao'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-map-marker"></i>
          <span>Localização</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.localizacao') active @endif">
            <a href="{{route('backend.localizacao')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.fale-conosco'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-question-circle"></i>
          <span>Fale Conosco</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.fale-conosco') active @endif">
            <a href="{{route('backend.fale-conosco')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.consorcio-novo'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-plus-circle"></i>
          <span>Consórcio Novo </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.consorcio-novo') active @endif">
            <a href="{{route('backend.consorcio-novo')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(), ['backend.cotas.compramos', 'backend.cotas.pagina.imoveis', 'backend.cotas.pagina.automoveis'])) active menu-open @endif">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Páginas de Cotas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Route::current()->getName() == 'backend.cotas.pagina.imoveis') active @endif">
              <a href="{{route('backend.cotas.pagina.imoveis')}}">
                <i class="fa fa-file-o"></i> Página de Imóveis</a>
            </li>
            <li class="@if(Route::current()->getName() == 'backend.cotas.pagina.automoveis') active @endif">
              <a href="{{route('backend.cotas.pagina.automoveis')}}">
                <i class="fa fa-file-o"></i> Página de Automóveis</a>
            </li>
            <li class="@if(Route::current()->getName() == 'backend.cotas.compramos') active @endif">
              <a href="{{route('backend.cotas.compramos')}}">
                <i class="fa fa-file-o"></i> Compramos Sua Cota </a>
            </li>
          </ul>
        </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.simulacao', 'backend.simulacao.obrigado'])) active menu-open @endif">
        <a href="#">
          <i class="fa fa-money"></i>
          <span>Página de Simulação</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.simulacao') active @endif">
            <a href="{{route('backend.simulacao')}}">
              <i class="fa fa-file-o"></i> Página </a>
          </li>
          <li class="@if(Route::current()->getName() == 'backend.simulacao.obrigado') active @endif">
            <a href="{{route('backend.simulacao.obrigado')}}">
              <i class="fa fa-file-o"></i> Página de Obrigado </a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array(Route::current()->getName(),['backend.configuracoes-tema'])) active menu-open @endif">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>Configurações do Tema </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if(Route::current()->getName() == 'backend.configuracoes-tema') active @endif">
              <a href="{{route('backend.configuracoes-tema')}}">
                <i class="fa fa-file-o"></i> Página </a>
            </li>
          </ul>
        </li>
      
      <li class="treeview @if(route::current()->getName() == 'backend.usuarios') active menu-open @endif">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Usuários</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if(Route::current()->getName() == 'backend.usuarios') active @endif">
            <a href="{{route('backend.usuarios')}}">
              <i class="fa fa-list"></i> Listar Usuários</a>
          </li>
        </ul>
      </li>
      <li class="@if(route::current()->getName() == 'backend.log') active @endif">
        <a href="{{route('backend.log')}}">
          <i class="fa fa-history"></i>
          <span>Log de Eventos</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>