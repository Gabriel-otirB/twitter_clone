<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {


	public function timeline() {

		$this->validaAutenticacao();
			
		//recuperação dos tweets
		$tweet = Container::getModel('Tweet');

		$tweet->__set('id_usuario', $_SESSION['id']);

		//Variáveis de páginação
		$total_registros_pagina = 10;
		$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
		$deslocamento = ($pagina - 1) * 10;

		$tweets = $tweet->getPorPagina($total_registros_pagina, $deslocamento);
		$total_tweets = $tweet->getTotalRegistros();
		$this->view->total_de_paginas = ceil($total_tweets['total'] / $total_registros_pagina);
		$this->view->pagina_ativa = $pagina;

		$this->view->tweets = $tweets;
		
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuario();
		$this->view->total_tweets = $usuario->getTotalTweets();
		$this->view->total_seguindo = $usuario->getTotalSeguindo();
		$this->view->total_seguidores = $usuario->getTotalSeguidores();

		$this->render('timeline');
		
	}

	public function tweet() {

		$this->validaAutenticacao();

		$tweet = Container::getModel('Tweet');

		if(empty($_POST['tweet'])) {
			return header('Location: /timeline?erro=tweetVazio');
		}

		if(strlen($_POST['tweet']) > 280) {
			$_SESSION['tweetDigitado'] = substr($_POST['tweet'], 0, 280);
			return header('Location: /timeline?erro=tweetLimite');
		}

		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('id_usuario', $_SESSION['id']);

		$tweet->salvar();

		return header('Location: /timeline');
		
	}
	public function remover() {

		$this->validaAutenticacao();

		$tweet = Container::getModel('Tweet');
		$tweet->__set('id', $_GET['id']);

		$tweet->remover();

		return header('Location: /timeline');
	}

	public function validaAutenticacao() {

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
			header('Location: /?login=erro');
		}	

	}

	public function quemSeguir() {

		$this->validaAutenticacao();

		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';
		
		$usuarios = array();

		if($pesquisarPor != '') {
			
			$usuario = Container::getModel('Usuario');
			$usuario->__set('nome', $pesquisarPor);
			$usuario->__set('id', $_SESSION['id']);
			$usuarios = $usuario->getAll();

		}

		//Dados do usuario perfil
		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuario();
		$this->view->total_tweets = $usuario->getTotalTweets();
		$this->view->total_seguindo = $usuario->getTotalSeguindo();
		$this->view->total_seguidores = $usuario->getTotalSeguidores();

		//Dados usuarios pesquisados
		$this->view->usuarios = $usuarios;

		$this->render('quemSeguir');
	}	

	public function acao() {

		$this->validaAutenticacao();

		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$id_usuario_seguindo = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		if($acao == 'seguir') {
			$usuario->seguirUsuario($id_usuario_seguindo);

		} else if($acao == 'deixar_de_seguir') {
			$usuario->deixarSeguirUsuario($id_usuario_seguindo);

		}

		header('Location: /quem_seguir');
	}
}
?>