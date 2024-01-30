<!DOCTYPE html>

<html lang="pt-br">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title / Icon -->
        <title>nomeCriativo - Lista Pedidos</title>
        <link rel="icon" href="https://i.pinimg.com/736x/2e/d5/7a/2ed57accf63d08e5ebb1ee853bed1832.jpg">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/frameworks/materialize/css/materialize.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('assets/css/estilo.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

        
        <link href="{{ asset('assets/js/jquery.mask.min.js') }}" rel="script">
        <script>
            $(document).ready(function($){
                $('#cep').mask('00000-000');
            });
        </script>
    </head>

    <body class="antialiased">
        <header>
            <!--Sidenav-->
			<ul id="sidenav" class="sidenav sidenav-fixed z-depth-0 light-blue darken-3 gradient-bottom">
				<a href="{{ route('admin.index') }}" class="brand-logo">
					<li id="box-logo" style="margin-top:24px;margin-bottom:24px;" class="white-text">
						<img id="logo" class="responsive-img" src="https://i.pinimg.com/736x/2e/d5/7a/2ed57accf63d08e5ebb1ee853bed1832.jpg" />
					</li>
                </a>
                <hr>
                <li>
					<a href="{{ route('admin.list') }}" class="white-text">
						<i class="material-icons">build</i>
						Admins
					</a>
				</li>
                <li>
					<a href="{{ route('ingresso.list') }}" class="white-text">
						<i class="material-icons">camera_roll</i>
						Ingresso
					</a>
				</li>
                <li>
					<a href="{{ route('pedido.list') }}" class="white-text">
						<i class="material-icons">add_shopping_cart</i>
						Pedidos
					</a>
				</li>
			</ul>

			<!--Navbar-->
			<nav id="nav" class="z-depth-0 grey">
				<div class="nav-wrapper">
					<a href="#" data-target="sidenav" class="sidenav-trigger">
						<i class="material-icons">menu</i>
					</a>
					<ul class="right">
						<li id="minha-conta">
							<a id="button-dropdown-my-account" class="dropdown-trigger" href="javascript:void(0);" data-target="dropdown-my-account">
								<i class="material-icons large">account_circle</i>
							</a>
							<!-- Dropdown Minha Conta -->
							<ul id="dropdown-my-account" class="dropdown-content">
                                <li>
									<a class="black-text">
                                        <i class="material-icons">person</i>
                                        {{ auth()->guard('admin')->user()->name }}
                                    </a>
								</li>
								<li>
									<a href="#" class="black-text">
										<i class="material-icons">settings</i>
										Minha Conta
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a class="dropdown-item black-text" href=""
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="material-icons">power_settings_new</i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
        </header>

        <!-- Tabela -->
        <div class="row">
            <div class="col s12 m10 l8 offset-l2 offset-m1">
                <div class="carta" style="width: 100%">
                    <div class="card" style="width: 600px">
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Ingressos</span>
                            <button id="btn-cadastrar" class="btn waves-effect waves-light blue-grey darken-3" type="submit" name="action">
                                <a href="{{ route('ingresso.create') }}" class="white-text">Cadastrar</a>
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                        <hr>
                        <div class="card-image waves-effect waves-block waves-light">
                            <table class="striped responsive-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Ingresso Quantidade</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pedidos as $pedido)
                                    <tr>
                                        <th>{{ $pedido->id }}</th>
                                        <th>{{ $pedido->user_id }}</th>
                                        <th>{{ $pedido->ingresso_qtd }}</th>
                                        <th>R${{ $pedido->total }},00</th>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            {!! $pedidos->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Footer -->
        <footer class="page-footer grey fixarRodape">
            <div class="footer-copyright">
                <div class="container">
                © 2022 Todos os direitos reservados ao nomeCriativo
                </div>                
            </div>
        </footer>

        <!-- scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('assets/frameworks/materialize/js/materialize.js') }}"></script>
        <script src="{{ asset('assets/js/teste.js') }}"></script>
        <link href="{{ asset('assets/js/jquery.mask.min.js') }}" rel="script">
    </body>
</html>