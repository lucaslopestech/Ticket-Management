<?php
	session_start();

	if(empty($_SESSION)){
		print "<script>location.href='index.php';</script>";
	}

  include('menu.php');

  switch(@$_REQUEST['pag']){
    //departamento
    case 'departamento-cadastrar':
      include('departamento-cadastrar.php');
      break;
    case 'departamento-editar':
      include('departamento-editar.php');
      break;
    case 'departamento-listar':
      include('departamento-listar.php');
      break;
    case 'departamento-salvar':
      include('departamento-salvar.php');
      break;
    //usuario
    case 'usuario-cadastrar':
      include('usuario-cadastrar.php');
      break;
    case 'usuario-editar':
      include('usuario-editar.php');
      break;
    case 'usuario-listar':
      include('usuario-listar.php');
      break;
    case 'usuario-salvar':
      include('usuario-salvar.php');
      break;
    //atendente
    case 'atendente-cadastrar':
      include('atendente-cadastrar.php');
      break;
    case 'atendente-editar':
      include('atendente-editar.php');
      break;
    case 'atendente-listar':
      include('atendente-listar.php');
      break;
    case 'atendente-salvar':
      include('atendente-salvar.php');
      break;
    //Ticket
    case 'abrir-ticket':
      include('abrir-ticket.php');
      break;
    case 'acompanhar-ticket':
      include('acompanhar-ticket.php');
      break;
    case 'ticket-fechados':
      include('ticket-fechados.php');
      break;


    default:
      include('main.php');
  }
?>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand"></a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="arrows">
  <img src="images/arrows.jpg" alt="arrows" width="100%">
</div>
