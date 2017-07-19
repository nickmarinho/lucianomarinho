<?php
/**
 * Controller to admin
 * @copyright  2011 Luciano Marinho
 * @package    Marcio Bernardes
 * @author Nick Marinho <nickmarinho@gmail.com> - 2011-03-06
 * @version    1.0  
 * @name AdminController.php
 */
include_once APP_PATH . "/class/common.class.php";
include_once APP_PATH . "/../www/js/ckeditor/ckeditor.php";

class AdminController extends Zend_Controller_Action
{
	/* LIST ACTIONS */
	public function listbancosAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "bancos";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Bancos");
		$this->setheaders();
		$request = $this->getRequest();
		$p = $request->get('p');
		$c = $request->get('c');
		$numero = $request->get('numero');
		$nome = $request->get('nome');
		$options = array();
		$_SESSION['numero'] = '';
		$_SESSION['nome'] = ''; 
		$model = $this->_getModelBancos();
		$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntries($options)));
		$currentPage = isset($p) ? (int) htmlentities($p) : 1;
		$pager->setCurrentPageNumber($currentPage);
		$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
		$pager->setItemCountPerPage($itemsPerPage);
		$this->view->paginator=$pager;
		$this->view->request = $request;
		$this->view->p = $p;
		$this->view->datalist = $pager->getCurrentItems();
		$this->view->pagename = $pagename;
		$this->view->numero = $numero;
		$this->view->nome = $nome;
	}
	
	public function listblogAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "blog";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Blog");
		$this->setheaders();
		$request = $this->getRequest();
		$p = $request->get('p');
		$c = $request->get('c');
		$title = $request->get('title');
		$options = array();
		$_SESSION['title'] = '';
		$_SESSION['name'] = '';
		$_SESSION['category'] = '';
		$_SESSION['user'] = '';
		$_SESSION['email'] = ''; 
		if(!empty($title)){ array_push($options, array('title' => $title)); $_SESSION['title'] = $title; }
		else $_SESSION['title'] = '';
		$model = $this->_getModelBlog();
		$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntries($options)));
		$currentPage = isset($p) ? (int) htmlentities($p) : 1;
		$pager->setCurrentPageNumber($currentPage);
		$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
		$pager->setItemCountPerPage($itemsPerPage);
		$this->view->paginator=$pager;
		$this->view->request = $request;
		$this->view->p = $p;
		$this->view->datalist = $pager->getCurrentItems();
		$this->view->pagename = $pagename;
		$this->view->title = $title;
	}
	
	public function listboletosAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "boletos";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Boletos");
		$this->setheaders();
		$request = $this->getRequest();
		$id_cliente = $request->get('id_cliente');
		$this->view->id_cliente = $id_cliente;
		
		if($id_cliente <> "")
		{
			$modelc = $this->_getModelClientes();
			$this->view->cliente = $modelc->fetchEntry($id_cliente);
			
			$p = $request->get('p');
			$c = $request->get('c');
			$model = $this->_getModelBoletos();
			$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntryByType(array('id_cliente' => $id_cliente))));
			$currentPage = isset($p) ? (int) htmlentities($p) : 1;
			$pager->setCurrentPageNumber($currentPage);
			$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
			$pager->setItemCountPerPage($itemsPerPage);
			$this->view->paginator=$pager;
			$this->view->request = $request;
			$this->view->p = $p;
			$this->view->datalist = $pager->getCurrentItems();
			$this->view->pagename = $pagename;
		}
	}
	
	public function listclientesAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "clientes";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Clientes");
		$this->setheaders();
		$request = $this->getRequest();
		$p = $request->get('p');
		$c = $request->get('c');
		$nome = $request->get('nome');
		$tipo = $request->get('tipo');
		$email = $request->get('email');
		$cpfcnpj = $request->get('cpfcnpj');
		$options = array();
		$_SESSION['nome'] = '';
		$_SESSION['tipo'] = '';
		$_SESSION['email'] = ''; 
		$_SESSION['cpfcnpj'] = '';
		if(!empty($nome)){ array_push($options, array('nome' => $nome)); $_SESSION['nome'] = $nome; }
		if(!empty($tipo)){ array_push($options, array('tipo' => $tipo)); $_SESSION['tipo'] = $tipo; }
		if(!empty($email)){ array_push($options, array('email' => $email)); $_SESSION['email'] = $email; }
		if(!empty($cpfcnpj)){ array_push($options, array('cpfcnpj' => $cpfcnpj)); $_SESSION['cpfcnpj'] = $cpfcnpj; }
		$model = $this->_getModelClientes();
		$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntries($options)));
		$currentPage = isset($p) ? (int) htmlentities($p) : 1;
		$pager->setCurrentPageNumber($currentPage);
		$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
		$pager->setItemCountPerPage($itemsPerPage);
		$this->view->paginator=$pager;
		$this->view->request = $request;
		$this->view->p = $p;
		$this->view->datalist = $pager->getCurrentItems();
		$this->view->pagename = $pagename;
		$this->view->nome = $nome;
	}
	
	public function listscriptsAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "scripts";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Scripts");
		$this->setheaders();
		$request = $this->getRequest();
		$p = $request->get('p');
		$c = $request->get('c');
		$name = $request->get('name');
		$category = $request->get('category');
		$options = array();
		$_SESSION['title'] = '';
		$_SESSION['name'] = '';
		$_SESSION['category'] = '';
		$_SESSION['user'] = '';
		$_SESSION['email'] = ''; 
		if(!empty($name)){ array_push($options, array('name' => $name)); $_SESSION['name'] = $name; }
		else $_SESSION['name'] = '';
		if(!empty($category)){ array_push($options, array('category_id' => $category)); $_SESSION['category'] = $category; }
		else $_SESSION['category'] = '';
		$model = $this->_getModelScripts();
		$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntries($options)));
		$currentPage = isset($p) ? (int) htmlentities($p) : 1;
		$pager->setCurrentPageNumber($currentPage);
		$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
		$pager->setItemCountPerPage($itemsPerPage);
		$this->view->paginator=$pager;
		$this->view->request = $request;
		$this->view->p = $p;
		$this->view->datalist = $pager->getCurrentItems();
		$this->view->pagename = $pagename;
		$this->view->name = $name;
	}
	
	public function listscriptscategoriesAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "scriptscategories";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Scripts Categories");
		$this->setheaders();
		$request = $this->getRequest();
		$p = $request->get('p');
		$c = $request->get('c');
		$name = $request->get('name');
		$options = array();
		$_SESSION['title'] = '';
		$_SESSION['name'] = '';
		$_SESSION['category'] = '';
		$_SESSION['user'] = '';
		$_SESSION['email'] = '';
		if(!empty($name)){ array_push($options, array('name' => $name)); $_SESSION['name'] = $name; }
		else $_SESSION['name'] = '';
		$model = $this->_getModelScriptsCategories();
		$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntries($options)));
		$currentPage = isset($p) ? (int) htmlentities($p) : 1;
		$pager->setCurrentPageNumber($currentPage);
		$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
		$pager->setItemCountPerPage($itemsPerPage);
		$this->view->paginator=$pager;
		$this->view->request = $request;
		$this->view->p = $p;
		$this->view->datalist = $pager->getCurrentItems();
		$this->view->pagename = $pagename;
		$this->view->name = $name;
	}
	
	public function listusersAction()
	{
		$this->view->layout()->disableLayout();
		$pagename = "users";
		$_SESSION['pagename'] = $pagename;
		$this->settitle("List Users");
		$this->setheaders();
		$request = $this->getRequest();
		$p = $request->get('p');
		$c = $request->get('c');
		$user = $request->get('user');
		$name = $request->get('name');
		$email = $request->get('email');
		$options = array();
		$_SESSION['title'] = '';
		$_SESSION['name'] = '';
		$_SESSION['category'] = '';
		$_SESSION['user'] = '';
		$_SESSION['email'] = ''; 
		if(!empty($user)){ array_push($options, array('user' => $user)); $_SESSION['user'] = $user; }
		else $_SESSION['user'] = '';
		if(!empty($name)){ array_push($options, array('name' => $name)); $_SESSION['name'] = $name; }
		else $_SESSION['name'] = '';
		if(!empty($email)){ array_push($options, array('email' => $email)); $_SESSION['email'] = $email; }
		else $_SESSION['email'] = '';
		$model = $this->_getModelUsers();
		$pager = new Zend_Paginator(new Zend_Paginator_Adapter_Array($model->fetchEntries($options)));
		$currentPage = isset($p) ? (int) htmlentities($p) : 1;
		$pager->setCurrentPageNumber($currentPage);
		$itemsPerPage = isset($c) ? (int) htmlentities($c) : 20;
		$pager->setItemCountPerPage($itemsPerPage);
		$this->view->paginator=$pager;
		$this->view->request = $request;
		$this->view->p = $p;
		$this->view->datalist = $pager->getCurrentItems();
		$this->view->user = $user;
		$this->view->name = $name;
		$this->view->email = $email;
	}
	
	/* SAVE ACTIONS */
	public function savebancosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$numero = $request->get('numero');
		$nome = utf8_decode(addslashes($request->get('nome')));
		$id = $request->get('id');
		$mdate = Common::returnData();
		$cdate = Common::returnData();
		$formData['numero'] = $numero;
		$formData['nome'] = $nome;
		$formData['mdate'] = $mdate;

		$model = $this->_getModelBancos();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo '<div class="success">Saved !!!</div>';
			echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listbancos();\",1000);</script>";
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id){
				echo '<div class="success">Saved !!!</div>';
				echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listbancos();\",1000);</script>";
			}
			else{
				$formData['nome'] = $request->get('nome');
				$form = $this->_getFormBancos();
				$form->setAction('savebancos');
				$form->populate($formData);
				echo "<div class='error'>Erro ao salvar, reveja o formulário !!!</div>\n";
				echo $form;
			}
		}
	}
	
	public function saveblogAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$category_id = $request->get('category_id');
		$url = utf8_decode(addslashes($request->get('url')));
		$title = utf8_decode(addslashes($request->get('title')));
		$meta_keywords = utf8_decode(addslashes($request->get('meta_keywords')));
		$meta_description = utf8_decode(addslashes($request->get('meta_description')));
		$rss = $request->get('rss');
		$post = $request->get('post');
		$author = utf8_decode(addslashes($request->get('author')));
		$id = $request->get('id');
		$mdate = Common::returnData();
		$cdate = Common::returnData();
		$formData['url'] = $url;
		$formData['title'] = $title;
		$formData['meta_keywords'] = $meta_keywords;
		$formData['meta_description'] = $meta_description;
		$formData['rss'] = $rss;
		$formData['post'] = $post;
		$formData['author'] = $author;
		$formData['mdate'] = $mdate;

		$model = $this->_getModelBlog();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo '<div class="success">Saved !!!</div>';
			echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listblog();\",1000);</script>";
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id){
				echo '<div class="success">Saved !!!</div>';
				echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listblog();\",1000);</script>";
			}
			else{
				$formData['url'] = $request->get('url');
				$formData['title'] = $request->get('title');
				$formData['meta_keywords'] = $request->get('meta_keywords');
				$formData['meta_description'] = $request->get('meta_description');
				$formData['rss'] = $request->get('rss');
				$formData['post'] = $request->get('post');
				$formData['author'] = $request->get('author');
				$form = $this->_getFormBlog();
				$form->setAction('saveblog');
				$form->populate($formData);
				echo "<div class='error'>Erro ao salvar, reveja o formulário !!!</div>\n";
				echo $form;
			}
		}
	}
	
	public function saveboletosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$id_cliente = $request->get('id_cliente');
		$valor = str_replace('.','',$request->get('valor'));
		$valor = str_replace(',','.',$valor);
		$vencimento = implode("-", array_reverse(explode("/", $request->get('vencimento'))));
		$mes_referencia = $request->get('mes_referencia');
		$numero = $request->get('numero');
		$obs = $request->get('obs');
		$id = $request->get('id');
		$mdate = Common::returnData();
		$cdate = Common::returnData();
		$formData['id_cliente'] = $id_cliente;
		$formData['valor'] = $valor;
		$formData['vencimento'] = $vencimento;
		$formData['mes_referencia'] = $mes_referencia;
		$formData['numero'] = $numero;
		$formData['obs'] = $obs;
		$formData['mdate'] = $mdate;

		$model = $this->_getModelBoletos();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo $id;
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id) echo $id;
			else echo 'error';
		}
	}
	
	public function saveclientesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$nome = utf8_decode(addslashes($request->get('nome')));
		$tipo = $request->get('tipo');
		$email = utf8_decode(addslashes($request->get('email')));
		$cpfcnpj = $request->get('cpfcnpj');
		$hospedagem = str_replace('.','',$request->get('hospedagem'));
		$hospedagem = str_replace(',','.',$hospedagem);
		$endereco1 = utf8_decode(addslashes($request->get('endereco1')));
		$endereco2 = utf8_decode(addslashes($request->get('endereco2')));
		$demonstrativo1 = utf8_decode(addslashes($request->get('demonstrativo1')));
		$demonstrativo2 = utf8_decode(addslashes($request->get('demonstrativo2')));
		$instrucao1 = utf8_decode(addslashes($request->get('instrucao1')));
		$instrucao2 = utf8_decode(addslashes($request->get('instrucao2')));
		$instrucao3 = utf8_decode(addslashes($request->get('instrucao3')));
		$id = $request->get('id');
		$mdate = Common::returnData();
		$cdate = Common::returnData();
		$formData['nome'] = $nome;
		$formData['tipo'] = $tipo;
		$formData['email'] = $email;
		$formData['cpfcnpj'] = $cpfcnpj;
		$formData['hospedagem'] = $hospedagem;
		$formData['endereco1'] = $endereco1;
		$formData['endereco2'] = $endereco2;
		$formData['demonstrativo1'] = $demonstrativo1;
		$formData['demonstrativo2'] = $demonstrativo2;
		$formData['instrucao1'] = $instrucao1;
		$formData['instrucao2'] = $instrucao2;
		$formData['instrucao3'] = $instrucao3;
		$formData['mdate'] = $mdate;

		$model = $this->_getModelClientes();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo '<div class="success">Saved !!!</div>';
			echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listclientes();\",1000);</script>";
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id){
				echo '<div class="success">Saved !!!</div>';
				echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listclientes();\",1000);</script>";
			}
			else{
				$formData['nome'] = $request->get('nome');
				$formData['tipo'] = $request->get('tipo');
				$formData['email'] = $request->get('email');
				$formData['hospedagem'] = $request->get('hospedagem');
				$formData['endereco1'] = $request->get('endereco1');
				$formData['endereco2'] = $request->get('endereco2');
				$formData['demonstrativo1'] = $request->get('demonstrativo1');
				$formData['demonstrativo2'] = $request->get('demonstrativo2');
				$formData['instrucao1'] = $request->get('instrucao1');
				$formData['instrucao2'] = $request->get('instrucao2');
				$formData['instrucao3'] = $request->get('instrucao3');
				$form = $this->_getFormClientes();
				$form->setAction('saveclientes');
				$form->populate($formData);
				echo "<pre>";
				print_r($request);
				echo "</pre>";
				echo "<div class='error'>Erro ao salvar, reveja o formulário !!!</div>\n";
				echo $form;
			}
		}
	}
	
	public function savescriptsAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$category_id = $request->get('category_id');
		$name = utf8_decode(addslashes($request->get('name')));
		$title = utf8_decode(addslashes($request->get('title')));
		$meta_keywords = utf8_decode(addslashes($request->get('meta_keywords')));
		$meta_description = utf8_decode(addslashes($request->get('meta_description')));
		$content = $request->get('content');
		$id = $request->get('id');
		$mdate = Common::returnData();
		$cdate = Common::returnData();
		$formData['category_id'] = $category_id;
		$formData['name'] = $name;
		$formData['title'] = $title;
		$formData['meta_keywords'] = $meta_keywords;
		$formData['meta_description'] = $meta_description;
		$formData['content'] = $content;
		$formData['mdate'] = $mdate;
		
		$model = $this->_getModelScripts();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo '<div class="success">Saved !!!</div>';
			echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listscripts();\",1000);</script>";
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id){
				echo '<div class="success">Saved !!!</div>';
				echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listscripts();\",1000);</script>";
			}
			else{
				$formData['name'] = $request->get('name');
				$formData['title'] = $request->get('title');
				$formData['meta_keywords'] = $request->get('meta_keywords');
				$formData['meta_description'] = $request->get('meta_description');
				$formData['content'] = $request->get('content');
				$form = $this->_getFormScripts();
				$form->setAction('savescripts');
				$form->populate($formData);
				echo "<div class='error'>Erro ao salvar, reveja o formulário !!!</div>\n";
				echo $form;
			}
		}
	}
	
	public function savescriptscategoriesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$name = utf8_decode(addslashes($request->get('name')));
		$id = $request->get('id');
		$cdate = Common::returnData();
		$mdate = Common::returnData();
		$formData['name'] = $name;
		$formData['mdate'] = $mdate;
		$model = $this->_getModelScriptsCategories();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo $id;
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id) echo $id;
			else echo 'error';
		}
	}
	
	public function saveusersAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$formData = array();
		$name = utf8_decode(addslashes($request->get('name')));
		$email = $request->get('email');
		$user = $request->get('user');
		$passwd = $request->get('passwd');
		$permissions = $request->get('permissions');
		$id = $request->get('id');
		$mdate = Common::returnData();
		$cdate = Common::returnData();
		$formData['name'] = $name;
		$formData['email'] = $email;
		$formData['user'] = $user;
		if(!empty($passwd)) $formData['passwd'] = md5($passwd);
		$formData['permissions'] = $permissions;
		$formData['mdate'] = $mdate;
		
		$model = $this->_getModelUsers();
		
		if(!empty($id)){
			$formData['id'] = $id;
			$model->update($formData, $id);
			echo '<div class="success">Saved !!!</div>';
			echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listusers();\",1000);</script>";
		}
		else
		{
			$formData['cdate'] = $cdate;
			$id = $model->save($formData);
			
			if($id){
				echo '<div class="success">Saved !!!</div>';
				echo "<script>setTimeout(\"jQuery.fn.modalBox('close');listusers();\",1000);</script>";
			}
			else{
				$formData['name'] = $request->get('name');
				$form = $this->_getFormUsers();
				$form->setAction('saveusers');
				$form->populate($formData);
				echo "<div class='error'>Erro ao salvar, reveja o formulário !!!</div>\n";
				echo $form;
			}
		}
	}
	
	/* ACTIVE | DISPLAY */
	public function activeonoffbancosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		if($request->get('id'))
		{
			$id = $request->get('id');
			$list = $request->get('list');
			$model = $this->_getModelBancos();
			$data = $model->fetchEntry($id);
			$mdate = Common::returnData();
			$formData = array();
			$formData['mdate'] = $mdate;

			if($data['ativo'] == '1')
			{
				$formData['ativo'] = '0';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:activeonoff('bancos','".$id."','".$list."');\" onmouseover=\"return overlib('Active OnOff Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/not-ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_active_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_active_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_active_".$id."').remove()\", 3000); </script>";
				}
			}
			else
			{
				$formData['ativo'] = '1';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:activeonoff('bancos','".$id."','".$list."');\" onmouseover=\"return overlib('Active OnOff ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_active_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_active_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_active_".$id."').remove()\", 3000); </script>";
				}
			}
		}
	}

	public function activeonoffclientesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		if($request->get('id'))
		{
			$id = $request->get('id');
			$list = $request->get('list');
			$model = $this->_getModelClientes();
			$data = $model->fetchEntry($id);
			$mdate = Common::returnData();
			$formData = array();
			$formData['mdate'] = $mdate;
			
			if($data['ativo'] == '1')
			{
				$formData['ativo'] = '0';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:activeonoff('clientes','".$id."','".$list."');\" onmouseover=\"return overlib('Active OnOff Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/not-ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_active_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_active_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_active_".$id."').remove()\", 3000); </script>";
				}
			}
			else
			{
				$formData['ativo'] = '1';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:activeonoff('clientes','".$id."','".$list."');\" onmouseover=\"return overlib('Active OnOff ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_active_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_active_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_active_".$id."').remove()\", 3000); </script>";
				}
			}
		}
	}

	public function activeonoffusersAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		if($request->get('id'))
		{
			$id = $request->get('id');
			$list = $request->get('list');
			$model = $this->_getModelUsers();
			$data = $model->fetchEntry($id);
			$mdate = Common::returnData();
			$formData = array();
			$formData['mdate'] = $mdate;
			
			if($data['active'] == '1')
			{
				$formData['active'] = '0';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:activeonoff('users','".$id."','".$list."');\" onmouseover=\"return overlib('Active OnOff Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/not-ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_active_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_active_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_active_".$id."').remove()\", 3000); </script>";
				}
			}
			else
			{
				$formData['active'] = '1';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:activeonoff('users','".$id."','".$list."');\" onmouseover=\"return overlib('Active OnOff ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_active_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_active_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_active_".$id."').remove()\", 3000); </script>";
				}
			}
		}
	}

	public function displayonoffblogAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		if($request->get('id'))
		{
			$id = $request->get('id');
			$list = $request->get('list');
			$model = $this->_getModelBlog();
			$data = $model->fetchEntry($id);
			$mdate = Common::returnData();
			$formData = array();
			$formData['mdate'] = $mdate;
			
			if($data['display'] == '1')
			{
				$formData['display'] = '0';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:displayonoff('blog','".$id."','".$list."');\" onmouseover=\"return overlib('Enable/Disable Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/not-ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_display_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_display_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_display_".$id."').remove()\", 3000); </script>";
				}
			}
			else
			{
				$formData['display'] = '1';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:displayonoff('blog','".$id."','".$list."');\" onmouseover=\"return overlib('Enable/Disable Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_display_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overb').addClass('overa');$('#updated_display_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_display_".$id."').remove()\", 3000); </script>";
				}
			}
		}
	}

	public function displayonoffscriptsAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		if($request->get('id'))
		{
			$id = $request->get('id');
			$list = $request->get('list');
			$model = $this->_getModelScripts();
			$data = $model->fetchEntry($id);
			$mdate = Common::returnData();
			$formData = array();
			$formData['mdate'] = $mdate;
			
			if($data['display'] == '1')
			{
				$formData['display'] = '0';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:displayonoff('scripts','".$id."','".$list."');\" onmouseover=\"return overlib('Enable/Disable Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/not-ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_display_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_display_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_display_".$id."').remove()\", 1000); </script>";
				}
			}
			else
			{
				$formData['display'] = '1';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:displayonoff('scripts','".$id."','".$list."');\" onmouseover=\"return overlib('Enable/Disable Display ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/ok.png' style='border:0px;cursor:pointer;' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_display_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overb').addClass('overa');$('#updated_display_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_display_".$id."').remove()\", 1000); </script>";
				}
			}
		}
	}
	
	public function pagonoffboletosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		if($request->get('id'))
		{
			$id = $request->get('id');
			$list = $request->get('list');
			$model = $this->_getModelBoletos();
			$data = $model->fetchEntry($id);
			$mdate = Common::returnData();
			$formData = array();
			$formData['mdate'] = $mdate;
			
			if($data['pago'] == '1')
			{
				$formData['pago'] = '0';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:pagonoff('boletos','".$id."','".$list."');\" onmouseover=\"return overlib('Pago ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/not-ok.png' class='img' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_pago_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overa').addClass('overb');$('#updated_pago_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_pago_".$id."').remove()\", 1000); </script>";
				}
			}
			else
			{
				$formData['pago'] = '1';
				if($model->update($formData, $id))
				{
					echo "   <a onclick=\"javascript:pagonoff('boletos','".$id."','".$list."');\" onmouseover=\"return overlib('Pago ID: ".$id."');\" onmouseout=\"return nd();\">\n";
					echo "    <img src='".SITE_PATH."/img/admin/ok.png' class='img' />\n";
					echo "   </a>\n";
					echo "<div id=\"updated_pago_".$id."\" style=\"color:#336699;\">OK</div>\n";
					echo "<script>$('#list_".$list."').removeClass('overb').addClass('overa');$('#updated_pago_".$id."').fadeOut().slideUp(500);setTimeout(\"$('#updated_pago_".$id."').remove()\", 1000); </script>";
				}
			}
		}
	}
	
	/* ADD ACTIONS */
	public function addbancosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$form = $this->_getFormBancos();
		$form->setAction('savebancos');
		echo $form;
	}
	
	public function addblogAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$form = $this->_getFormBlog();
		$form->setAction('saveblog');
		
		echo "<style>table.login{width:620px !important;}</style>\n";
		echo $form;
		echo "<script type=\"text/javascript\">\n";
		echo "$(document).ready(function(){\n";
		echo "	var post_instance = CKEDITOR.instances['post'];\n";
		echo "	if(post_instance){ CKEDITOR.remove(post_instance); }\n";
		echo "	var rss_instance = CKEDITOR.instances['rss'];\n";
		echo "	if(rss_instance){ CKEDITOR.remove(rss_instance); }\n";
		echo "	CKEDITOR.replace('rss');\n";
		echo "	CKEDITOR.replace('post');\n";
		echo "	$(\"#post-label\").attr('style','vertical-align:top;');\n";
		echo "	var imagetemplate = \"<a class='button' href='javascript:void(0);' onclick='imagetemplate(\";\n";
		echo "	imagetemplate += '\"post\"';\n";
		echo "	imagetemplate += \");'>Image</a>\";\n";
		echo "	$(\"#post-label\").html($(\"#post-label\").html()+imagetemplate);\n";
		echo "	$(\".button\").button();\n";
		echo "	$(\"#submitbutton\").click(function(){\n";
		echo "		var rss_editor_data = CKEDITOR.instances.rss.getData();\n";
		echo "		$(\"#rss\").text(rss_editor_data);\n";
		echo "		var post_editor_data = CKEDITOR.instances.post.getData();\n";
		echo "		$(\"#post\").text(post_editor_data);\n";
		echo "	});\n";
		echo "});\n";
		echo "</script>\n";
	}
	
	public function addboletosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$id_cliente = $request->get('id_cliente');
		$model = $this->_getModelBoletos();
		$model->setidcliente($id_cliente);
		$ultimonumero = $this->_getModelBoletos()->fetchLastNumero();
		echo $ultimonumero['numero'];
	}
	
	public function addclientesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$form = $this->_getFormClientes();
		$form->setAction('saveclientes');
		echo $form;
		echo "<script type=\"text/javascript\" src=\"/js/jquery/jquery.maskmoney.js\"></script>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "$(\"#hospedagem\").maskMoney({symbol:'R$ ', showSymbol:false, thousands:'.', decimal:',', symbolStay: true});\n";
		echo "</script>\n";
		echo "<style>table.login{width:610px;}</style>\n";
	}
	
	public function addscriptsAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$form = $this->_getFormScripts();
		$form->setAction('savescripts');
		echo "<style>table.login{width:620px !important;}</style>\n";
		echo $form;
		echo "<script type=\"text/javascript\">\n";
		echo "$(document).ready(function(){\n";
		echo "	var instance = CKEDITOR.instances['content'];\n";
		echo "	if(instance)\n";
		echo "	{\n";
		echo "		CKEDITOR.remove(instance);\n";
		echo "	}\n";
		echo "	CKEDITOR.replace('content');\n";
		echo "	$(\"#content-label\").attr('style','vertical-align:top;');\n";
		echo "	var imagetemplate = \"<a class='button' href='javascript:void(0);' onclick='imagetemplate(\";\n";
		echo "	imagetemplate += '\"content\"';\n";
		echo "	imagetemplate += \");'>Image</a>\";\n";
		echo "	$(\"#content-label\").html($(\"#content-label\").html()+imagetemplate);\n";
		echo "	$(\".button\").button();\n";
		echo "	$(\"#submitbutton\").click(function(){\n";
		echo "		var content_editor_data = CKEDITOR.instances.content.getData();\n";
		echo "		$(\"#content\").text(content_editor_data);\n";
		echo "	});\n";
		echo "});\n";
		echo "</script>\n";
	}
	
	public function addusersAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$form = $this->_getFormUsers();
		$form->setAction('saveusers');
		echo $form;
	}

	/* EDIT ACTIONS */
	public function editbancosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelBancos();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		$form = $this->_getFormBancos(array('id' => $id));
		$form->setAction('savebancos');
		
		$formData = array();
		foreach($row as $key => $value){
			$formData[$key] = utf8_encode(stripslashes($value));
		}
		
		$form->populate($formData);
		echo $form;
	}
		
	public function editblogAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelBlog();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		$form = $this->_getFormBlog(array('id' => $id));
		$form->setAction('saveblog');
		
		$formData = array();
		foreach($row as $key => $value){
			$formData[$key] = utf8_encode(stripslashes($value));
		}
		
		$form->populate($formData);
		echo "<style>table.login{width:620px !important;}</style>\n";
		echo $form;
		echo "<script type=\"text/javascript\">\n";
		echo "$(document).ready(function(){\n";
		echo "	var post_instance = CKEDITOR.instances['post'];\n";
		echo "	if(post_instance){ CKEDITOR.remove(post_instance); }\n";
		echo "	var rss_instance = CKEDITOR.instances['rss'];\n";
		echo "	if(rss_instance){ CKEDITOR.remove(rss_instance); }\n";
		echo "	CKEDITOR.replace('rss');\n";
		echo "	CKEDITOR.replace('post');\n";
		echo "	$(\"#post-label\").attr('style','vertical-align:top;');\n";
		echo "	var imagetemplate = \"<a class='button' href='javascript:void(0);' onclick='imagetemplate(\";\n";
		echo "	imagetemplate += '\"post\"';\n";
		echo "	imagetemplate += \");'>Image</a>\";\n";
		echo "	$(\"#post-label\").html($(\"#post-label\").html()+imagetemplate);\n";
		echo "	$(\".button\").button();\n";
		echo "	$(\"#submitbutton\").click(function(){\n";
		echo "		var rss_editor_data = CKEDITOR.instances.rss.getData();\n";
		echo "		$(\"#rss\").text(rss_editor_data);\n";
		echo "		var post_editor_data = CKEDITOR.instances.post.getData();\n";
		echo "		$(\"#post\").text(post_editor_data);\n";
		echo "	});\n";
		echo "});\n";
		echo "</script>\n";
	}
		
	public function editboletosAction()
	{
		$this->view->layout()->disableLayout();
		$request = $this->getRequest();
		$model = $this->_getModelBoletos();
		$id_cliente = $request->get('id_cliente');
		$id = $request->get('id');
		$div = $request->get('div');
		$row = $model->fetchEntry($id);
		$this->view->id_cliente = $id_cliente;
		$this->view->row = $row;
		$this->view->div = $div;
	}
	
	public function editclientesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelClientes();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		$form = $this->_getFormClientes(array('id' => $id));
		$form->setAction('saveclientes');
		
		$formData = array();
		foreach($row as $key => $value){
			if($key == 'hospedagem') $value = number_format($value, 2, ',', '.');
			$formData[$key] = utf8_encode(stripslashes($value));
		}
		
		$form->populate($formData);
		echo $form;
		echo "<script type=\"text/javascript\" src=\"/js/jquery/jquery.maskmoney.js\"></script>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "$(\"#hospedagem\").maskMoney({symbol:'R$ ', showSymbol:false, thousands:'.', decimal:',', symbolStay: true});\n";
		echo "</script>\n";
		echo "<style>table.login{width:610px;}</style>\n";
	}

	public function editscriptsAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelScripts();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		$form = $this->_getFormScripts(array('id' => $id));
		$form->setAction('savescripts');
		
		$formData = array();
		foreach($row as $key => $value){
			$formData[$key] = utf8_encode(stripslashes($value));
		}
		
		$form->populate($formData);
		echo "<style>table.login{width:620px !important;}</style>\n";
		echo $form;
		echo "<script type=\"text/javascript\">\n";
		echo "$(document).ready(function(){\n";
		echo "	var content_instance = CKEDITOR.instances['content'];\n";
		echo "	if(content_instance)\n";
		echo "	{\n";
		echo "		CKEDITOR.remove(content_instance);\n";
		echo "	}\n";
		echo "	CKEDITOR.replace('content');\n";
		echo "	$(\"#content-label\").attr('style','vertical-align:top;');\n";
		echo "	var imagetemplate = \"<a class='button' href='javascript:void(0);' onclick='imagetemplate(\";\n";
		echo "	imagetemplate += '\"content\"';\n";
		echo "	imagetemplate += \");'>Image</a>\";\n";
		echo "	$(\"#content-label\").html($(\"#content-label\").html()+imagetemplate);\n";
		echo "	$(\".button\").button();\n";
		echo "	$(\"#submitbutton\").click(function(){\n";
		echo "		var content_editor_data = CKEDITOR.instances.content.getData();\n";
		echo "		$(\"#content\").text(content_editor_data);\n";
		echo "	});\n";
		echo "});\n";
		echo "</script>\n";
	}
	
	public function editscriptscategoriesAction()
	{
		$this->view->layout()->disableLayout();
		$request = $this->getRequest();
		$model = $this->_getModelScriptsCategories();
		$id = $request->get('id');
		$div = $request->get('div');
		$row = $model->fetchEntry($id);
		$this->view->row = $row;
		$this->view->div = $div;
	}
	
	public function editusersAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelUsers();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		$form = $this->_getFormUsers(array('id' => $id));
		$form->setAction('saveusers');
		
		$formData = array();
		foreach($row as $key => $value){
			$formData[$key] = utf8_encode(stripslashes($value));
		}
		
		$form->populate($formData);
		echo $form;
	}
	
	/* DEL ACTIONS */
	public function removebancosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelBancos();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	public function removeblogAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelBlog();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	public function removeboletosAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelBoletos();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	public function removeclientesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelClientes();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	public function removescriptsAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelScripts();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	public function removescriptscategoriesAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelScriptsCategories();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	public function removeusersAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		
		if($request->get('id'))
		{
			$model = $this->_getModelUsers();
			if($model->delete($request->get('id'))) echo '1';
		}
		else echo 'error';
	}
	
	/* EXPORT PDF */
	public function exportpdfboletosAction()
	{
		$this->view->layout()->disableLayout();
		$request = $this->getRequest();
		$id_banco = $request->get('id_banco');
		$id_boleto = $request->get('id_boleto');
		$id = $request->get('id');
		
		if($id_banco <> '' && $id_boleto <> ''){
			$modelbancos = $this->_getModelBancos();
			$modelboletos = $this->_getModelBoletos();
			$dadosboletodb = $modelboletos->fetchEntry($id_boleto);
			$modelclientes = $this->_getModelClientes();
			$dadoscliente = $modelclientes->fetchEntry($dadosboletodb['id_cliente']);
			
			$dias_de_prazo_para_pagamento = 5;
			$taxa_boleto = 3.50;
			
			if(!empty($dadosboletodb['vencimento'])) $data_venc = date("d/m/Y", strtotime($dadosboletodb['vencimento']));
			else $data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));
			// Prazo de X dias OU informe data: "13/04/2006"; 
			
			if(!empty($dadosboletodb['valor'])) $valor_cobrado = $dadosboletodb['valor'];
			else $valor_cobrado = "30,00";
			// Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
			
			$valor_cobrado = str_replace(",", ".", $valor_cobrado); 
			$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
			
			if(!empty($dadosboletodb['numero'])) $dadosboleto["nosso_numero"] = $dadosboletodb["numero"];
			else $dadosboleto["nosso_numero"] = '1';
			// Nosso numero - REGRA: Maximo de 8 caracteres!
			
			if(!empty($dadosboletodb['numero'])) $dadosboleto["numero_documento"] = $dadosboletodb["numero"];
			else $dadosboleto["numero_documento"] = '1';
			// Num do pedido ou nosso numero
			
			$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
			$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissao do Boleto
			$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
			$dadosboleto["valor_boleto"] = $valor_boleto;
			// Valor do Boleto - REGRA: com virgula e sempre com duas casas depois da virgula
			
			// DADOS DO SEU CLIENTE
			$dadosboleto["sacado"] = utf8_decode(htmlentities($dadoscliente['nome']));
			$dadosboleto["endereco1"] = utf8_decode(htmlentities($dadoscliente["endereco1"])); // RUA NUMERO B J
			$dadosboleto["endereco2"] = utf8_decode(htmlentities($dadoscliente["endereco2"])); // CIDADE / UF
			
			// INFORMACOES PARA O CLIENTE
			$dadosboleto["demonstrativo1"] = utf8_decode(htmlentities($dadoscliente["demonstrativo1"]));
			//"Pagamento de Hospedagem de Website Mensal";
			$dadosboleto["demonstrativo2"] = utf8_decode(htmlentities($dadoscliente["demonstrativo2"])) . " - " . $dadosboletodb['mes_referencia'];
			//"Mensalidade referente a " . date('m/Y');
			$dadosboleto["demonstrativo3"] = "Taxa bancária - R$ " . number_format($taxa_boleto, 2, ',', '');
			
			$dadosboleto["instrucoes1"] = utf8_decode(htmlentities($dadoscliente["instrucao1"]));
			//"- Sr. Caixa, cobrar multa de 5% apos o vencimento";
			$dadosboleto["instrucoes2"] = utf8_decode(htmlentities($dadoscliente["instrucao2"]));
			//"- Receber ate 20 dias apos o vencimento";
			$dadosboleto["instrucoes3"] = utf8_decode(htmlentities($dadoscliente["instrucao3"]));
			//"- Em caso de duvidas entre em contato conosco: contato@lucianomarinho.com.br";
			$dadosboleto["instrucoes4"] = "";
			
			// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
			$dadosboleto["quantidade"] = "";
			$dadosboleto["valor_unitario"] = "";
			$dadosboleto["aceite"] = "";		
			$dadosboleto["especie"] = "R$";
			$dadosboleto["especie_doc"] = "";
			
			// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
			// DADOS DA SUA CONTA - ITAÚ
			$dadosboleto["agencia"] = "3128"; // Num da agencia, sem digito
			$dadosboleto["conta"] = "06783";  // Num da conta, sem digito
			$dadosboleto["conta_dv"] = "6";	  // Digito do Num da conta
			
			// DADOS PERSONALIZADOS - ITAÚ
			$dadosboleto["carteira"] = "157"; // Codigo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157
			
			// SEUS DADOS
			$dadosboleto["identificacao"] = "LUCIANO MARINHO DE ALMEIDA";
			$dadosboleto["cpf_cnpj"] = "114.946.638-30";
			$dadosboleto["endereco"] = "TRAV XAVIER SAMPAIO 136 B J NOVA BRASILIA";
			$dadosboleto["cidade_uf"] = "SÃO PAULO / SP";
			$dadosboleto["cedente"] = "LUCIANO MARINHO DE ALMEIDA<br />Análise e Desenvolvimento de Websites e Sistemas";
			
			// NAO ALTERAR!
			include_once APP_PATH . "/class/boleto/funcoes_itau.php";
			
			//if(!empty($_POST['tipo']))
			//{
				//if($_POST['tipo'] == '1') include_once APP_PATH . "/class/boleto/layout_itau_pdf.php"; // tipo 1 = gerar pdf
				//else 
				include_once APP_PATH . "/class/boleto/layout_itau.php"; // aqui só mostra
			//}

			//echo "id_banco=$id_banco <br />\n";
			//echo "id_boleto=$id_boleto <br />\n";
		}
		else if($id)
		{
			$form = $this->_getFormBoletosPdf(array('id_boleto' => $id));
			$form->setAction('/admin/exportpdfboletos');
			$this->view->form = $form;
		}
		else{ echo "<h1>Para imprimir um boleto voc&ecirc; precisa antes entrar em clientes -> boletos</h1>"; }
	}
	
	/* FETCHBYID ACTIONS (just for add or edit in place, not in modalbox) */
	public function fetchbyidboletosAction()
	{
		$this->view->layout()->disableLayout();
		$request = $this->getRequest();
		$model = $this->_getModelBoletos();
		$id = $request->get('id');
		$div = $request->get('div');
		$row = $model->fetchEntry($id);
		$this->view->row = $row;
		$this->view->div = $div;
	}
	
	public function fetchbyidscriptscategoriesAction()
	{
		$this->view->layout()->disableLayout();
		$request = $this->getRequest();
		$model = $this->_getModelScriptsCategories();
		$id = $request->get('id');
		$div = $request->get('div');
		$row = $model->fetchEntry($id);
		$this->view->row = $row;
		$this->view->div = $div;
	}
	
	/* VIEW ACTIONS */
	public function viewblogAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelBlog();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		if(count($row) > 0) echo utf8_encode(stripslashes($row['post']));
		else echo "Nada para mostrar";
	}
	
	public function viewscriptsAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
		$request = $this->getRequest();
		$model = $this->_getModelScripts();
		$id = $request->get('id');
		$row = $model->fetchEntry($id);
		if(count($row) > 0)
		{
			$data = str_replace('&gt;', '>', $row['content']);
			$data = str_replace('&lt;', '<', $data);
			$data = str_replace('&amp;', '&', $data);
			echo utf8_encode(stripslashes($data));
		}
		else echo "Nada para mostrar";
	}

	/* INIT */
	public function init()
	{
		$auth = Zend_Auth::getInstance();
		if(!$auth->hasIdentity ())
		{
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			{
				echo "<script>document.location = '" . SITE_PATH . "/admin';</script>";
			}
			else{ $this->_forward('login'); }
		}
		else
		{
			$authNamespace = new Zend_Session_Namespace('Zend_Auth');
			$authNamespace->setExpirationSeconds(86400);
			$timeLeftTillSessionExpires = $_SESSION['__ZF']['Zend_Auth']['ENT'] - time();
			$this->view->userdata = $auth->getIdentity();
			$this->view->sessionexpiresin = $timeLeftTillSessionExpires;
		}
	}

	public function indexAction()
	{
		$this->settitle("Home of Admin");
		$this->setheaders();
		$auth = Zend_Auth::getInstance();
		$user = $auth->getIdentity();
		$model = $this->_getModelUsers()->fetchLastLogin($user->id);
		$userdata=array();
		$userdata['name'] = $user->name;

		if(!empty($model['last_login']))
		{
			$userdata['last_login'] = $model['last_login'];
			$this->view->userdata = $userdata;
		}
	}
	
	public function gettitle()
	{
		return $this->title;
	}
	
	public function settitle($value)
	{
		$this->title = $value;
	}
	
	public function setheaders()
	{
		$this->_helper->layout()->getView()->headTitle($this->gettitle());
	}
	
	/* LOGIN LOGOUT ACTION */
	public function loginAction()
	{
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity ()){ $this->_forward('index'); }
		
		$this->settitle("Login Page");
		$this->setheaders();
		$request = $this->getRequest();
		$form = $this->_getAdminLoginForm();
		$errorMessage = "";

		if($request->isPost())
		{
			if($form->isValid($request->getPost()))
			{
				$registry = Zend_Registry::getInstance();
				$dbAdapter = $registry->get('dbAdapter');
				$user = $request->getParam('user');
				$passwd = $request->getParam('passwd');
				$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
				$authAdapter->setTableName('users')
					->setIdentityColumn('user')
					->setCredentialColumn('passwd');
				$authAdapter->setIdentity($user);
				$authAdapter->setCredential(md5($passwd));
				$auth = Zend_Auth::getInstance ();
				$result = $auth->authenticate($authAdapter);
				$authNamespace = new Zend_Session_Namespace('Zend_Auth');
				$authNamespace->setExpirationSeconds(86400);
				//Zend_Session::setOptions(array('remember_me_seconds' => '86400'));

				if($result->isValid())
				{
					$data = $authAdapter->getResultRowObject(null, 'passwd');
					$auth->getStorage()->write($data);
					$registry->userdata = $data;
					$_SESSION['user_active'] = $registry->userdata->active;
					$_SESSION['last_login'] = $registry->userdata->last_login;
					
					if($_SESSION['user_active'] == 1)
					{
						$model = $this->_getModelUsers();
						$mdata = Common::returnData();
						$model->update(array("last_login" => $mdata), $registry->userdata->id);
						echo "<script type=\"text/javascript\">location='" . SITE_PATH . "/admin/';</script>";
					}
					else
					{
						echo "<script type=\"text/javascript\">alert('User disable to log in');location='" . SITE_PATH . "/admin/logout';</script>";
					}
				}
				else $errorMessage = "User/Password wrong";
			}
		}

		$this->view->assign('errorMessage', $errorMessage);
		$this->view->form = $form;
	}

	public function logoutAction()
	{
		$this->view->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$auth = Zend_Auth::getInstance();
		if(! $auth->hasIdentity ()) $this->_redirect(SITE_PATH . '/admin/login');

		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		echo "<script type=\"text/javascript\">location='" . SITE_PATH . "/admin/';</script>";
	}
	
	/* PROTECTED FORMS AND MODELS */
	protected $_formbancos;
	protected $_modelbancos;
	protected $_formblog;
	protected $_modelblog;
	protected $_formboletos;
	protected $_formboletospdf;
	protected $_modelboletos;
	protected $_formclientes;
	protected $_modelclientes;
	protected $_formscript;
	protected $_modelscript;
	protected $_formscriptcategories;
	protected $_modelscriptcategories;
	protected $_formusers;
	protected $_modelusers;
	private $title;
	
	/* GET FORMS */
	protected function _getAdminLoginForm()
	{
		require_once APP_PATH . '/forms/FormAdminLogin.php';
		$form = new Form_AdminLogin();
		$form->setAction($this->_helper->url('login'));
		return $form;
	}

	protected function _getFormBancos($options = null)
	{
		if(null === $this->_formbancos)
		{
			require_once APP_PATH . '/forms/FormBancos.php';
			$this->_formbancos = new Form_Bancos($options);
		}
		
		return $this->_formbancos;
	}
	
	protected function _getFormBlog($options = null)
	{
		if(null === $this->_formblog)
		{
			require_once APP_PATH . '/forms/FormBlog.php';
			$this->_formblog = new Form_Blog($options);
		}
		
		return $this->_formblog;
	}
	
	protected function _getFormBoletos($options = null)
	{
		if(null === $this->_formboletos)
		{
			require_once APP_PATH . '/forms/FormBoletos.php';
			$this->_formboletos = new Form_Boletos($options);
		}
		
		return $this->_formboletos;
	}
	
	protected function _getFormBoletosPdf($options = null)
	{
		if(null === $this->_formboletospdf)
		{
			require_once APP_PATH . '/forms/FormBoletosPdf.php';
			$this->_formboletospdf = new Form_BoletosPdf($options);
		}
		
		return $this->_formboletospdf;
	}
	
	protected function _getFormClientes($options = null)
	{
		if(null === $this->_formclientes)
		{
			require_once APP_PATH . '/forms/FormClientes.php';
			$this->_formclientes = new Form_Clientes($options);
		}
		
		return $this->_formclientes;
	}
	
	protected function _getFormScripts($options = null)
	{
		if(null === $this->_formscripts)
		{
			require_once APP_PATH . '/forms/FormScripts.php';
			$this->_formscripts = new Form_Scripts($options);
		}
		
		return $this->_formscripts;
	}
	
	protected function _getFormScriptsCategories($options = null)
	{
		if(null === $this->_formscriptscategories)
		{
			require_once APP_PATH . '/forms/FormScriptsCategories.php';
			$this->_formscriptscategories = new Form_ScriptsCategories($options);
		}
		
		return $this->_formscriptscategories;
	}
	
	protected function _getFormUsers($options = null)
	{
		if(null === $this->_formusers)
		{
			require_once APP_PATH . '/forms/FormUsers.php';
			$this->_formusers = new Form_Users($options);
		}
		
		return $this->_formusers;
	}
	
	/* GET MODELS */
	protected function _getModelBancos()
	{
		if(null === $this->_modelbancos)
		{
			require_once APP_PATH . '/models/Bancos.php';
			$this->_modelbancos = new Model_Bancos();
		}
		
		return $this->_modelbancos;
	}

	protected function _getModelBlog()
	{
		if(null === $this->_modelblog)
		{
			require_once APP_PATH . '/models/Blog.php';
			$this->_modelblog = new Model_Blog();
		}
		
		return $this->_modelblog;
	}

	protected function _getModelBoletos()
	{
		if(null === $this->_modelboletos)
		{
			require_once APP_PATH . '/models/Boletos.php';
			$this->_modelboletos = new Model_Boletos();
		}
		
		return $this->_modelboletos;
	}

	protected function _getModelClientes()
	{
		if(null === $this->_modelclientes)
		{
			require_once APP_PATH . '/models/Clientes.php';
			$this->_modelclientes = new Model_Clientes();
		}
		
		return $this->_modelclientes;
	}

	protected function _getModelScripts()
	{
		if(null === $this->_modelscripts)
		{
			require_once APP_PATH . '/models/Scripts.php';
			$this->_modelscripts = new Model_Scripts();
		}
		
		return $this->_modelscripts;
	}

	protected function _getModelScriptsCategories()
	{
		if(null === $this->_modelscriptscategories)
		{
			require_once APP_PATH . '/models/ScriptsCategories.php';
			$this->_modelscriptscategories = new Model_ScriptsCategories();
		}
		
		return $this->_modelscriptscategories;
	}

	protected function _getModelUsers()
	{
		if(null === $this->_modelusers)
		{
			require_once APP_PATH . '/models/Users.php';
			$this->_modelusers = new Model_Users();
		}
		
		return $this->_modelusers;
	}
}
?>