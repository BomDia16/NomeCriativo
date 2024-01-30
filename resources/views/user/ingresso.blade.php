<!DOCTYPE html>

<html lang="pt-br">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title / Icon -->
        <title>nomeCriativo - {{ $ingresso->titulo }}</title>
        <link rel="icon" href="https://i.pinimg.com/736x/2e/d5/7a/2ed57accf63d08e5ebb1ee853bed1832.jpg">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/frameworks/materialize/css/materialize.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('assets/css/estilo.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


        
        <link href="{{ asset('assets/js/jquery.mask.min.js') }}" rel="script">
        <script>
            $(document).ready(function($){
                $('#cep').mask('00000-000');
            });
        </script>
        <style>
            .alert {
            padding: 20px;
            background-color: green;
            color: white;
            }
            .alert-error {
            padding: 20px;
            background-color: red;
            color: white;
            }

            .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
            }

            .closebtn:hover {
            color: black;
            }
        </style>
    </head>

    <body class="antialiased">
        <header>
            <!--Sidenav-->
			<ul id="sidenav" class="sidenav sidenav-fixed z-depth-0 light-blue darken-3 gradient-bottom">
				<a href="{{ route('user.index') }}" class="brand-logo">
					<li id="box-logo" style="margin-top:24px;margin-bottom:24px;" class="white-text">
						<img id="logo" class="responsive-img" src="https://i.pinimg.com/736x/2e/d5/7a/2ed57accf63d08e5ebb1ee853bed1832.jpg" />
					</li>
                </a>
                <hr>
                <li>
					<a href="{{ route('pedido.index') }}" class="white-text">
						<i class="material-icons">shopping_cart</i>
						Meus pedidos
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
                            @if(auth()->check())
                                <li>
									<a class="black-text">
                                        <i class="material-icons">person</i>
                                            {{ auth()->user()->name }}
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

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</li>
                                @else
                                <li>
                                    <a href="{{ route('view.login') }}" class="black-text">
                                        <i class="material-icons">lock_outline</i>
                                        Login
                                    </a>
								</li>
                                @endif
							</ul>
						</li>
					</ul>
				</div>
			</nav>
        </header>

        <div class="container">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-2 mb-2">
                    <div class="row">
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4"><h3>Informações do pedido</h3></span>
                        </div>
                        <hr>
                        <div class="input-field col s6">
                            <img id="compra-img" src="{{ $ingresso->imagem }}" class="img-produto">
                        </div>
                        <div class="card-image waves-effect waves-block waves-light">
                        @if (session('success'))
                            <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert-error">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                {{ session('error') }}
                            </div>
                        @endif
                            <form action="{{ route('pedido.store') }}" method="post">
                                @csrf
                                
                                <div class="input-field col s12">
                                    <span class="card-title activator grey-text text-darken-4">Ingresso: {{$ingresso->titulo}}</span>
                                </div>

                                <div class="input-field col s12">
                                    <span class="card-title activator grey-text text-darken-4">Preço de 1: R${{$ingresso->preco}},00</span>
                                </div>

                                <!-- QTD -->
                                <div class="input-field col s12">
                                    <input name="ingresso_qtd" type="number" min="1" id="ingresso_qtd" class="validate @error('ingresso_qtd') is-invalid @enderror">
                                    <label for="ingresso_qtd">Quantidade de ingressos</label>
                                        @error('ingresso_qtd')
                                            <div class="red-text">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <!-- Sexo -->
                                <div class="input-field col s12">
                                    <select name="sexo">
                                        <option class="black-text" name="sexo" value="1">Homem</option>
                                        <option class="black-text" name="sexo" value="2">Mulher</option>
                                    </select>
                                    <label>Sexo</label>
                                </div>

                                <!-- Ingresso ID -->
                                <input type="hidden" name="ingresso_id" value="{{ $ingresso->id }}">

                                <button id="cadastrar" class="btn waves-effect waves-light blue-grey darken-3" type="submit">
                                    Confirmar pedido
                                    <i class="material-icons right">send</i>
                                </button>
                            </form>
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