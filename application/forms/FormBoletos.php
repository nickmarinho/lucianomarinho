<?php
/**
 * Form to Boletos
 * @copyright  2011 Luciano Marinho
 * @package    Luciano Marinho
 * @author Nick Marinho <nickmarinho@gmail.com> - 2011-09-16
 * @version    1.0  
 * @name FormBoletos.php
 */
class Form_Boletos extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
		$this->setName('form_boletos')
			->setEnctype('multipart/form-data')
			->setMethod('post')
			->setDecorators(array(
								'FormElements',
								array('HtmlTag', array('tag' => 'table', 'class' => 'login', 'align' => 'center')),
								'Form'
							));

		$decoratorOptions = array(
			'ViewHelper',
			'Errors',
			array(array('data' => 'HtmlTag'), array('tag' => 'td')),
			array('Label', array('tag' => 'td')),
			array(array('row' => 'HtmlTag'), array(
												'tag' => 'tr', 
												'class' => 'impar', 
												'onmouseover' => 'this.className=\'over\';', 
												'onmouseout' => 'this.className=\'impar\';')
											)
		);

		$id_cliente = new Zend_Form_Element_Select('id_cliente');
		$id_cliente->setLabel('* Cliente: ')
					->setAttrib('size', 1)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		include_once APP_PATH . "/models/Clientes.php";
		$clientesOptions = new Model_Clientes();
		foreach($clientesOptions->fetchEntries() as $clientes){
			$id_cliente->addMultiOption($clientes['id'], utf8_encode(stripslashes($clientes['nome'])));
		}

		$valor = new Zend_Form_Element_Text('valor');
		$valor->setLabel('* Valor: ')
					->setAttrib('size', 40)
					->setAttrib('onkeyup', 'javascript:loadtools();')
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		  
		$vencimento = new Zend_Form_Element_Text('vencimento');
		$vencimento->setLabel('* Vencimento: ')
					->setAttrib('size', 40)
					->setAttrib('onkeyup', 'javascript:loadtools();')
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		  
		$numero = new Zend_Form_Element_Text('numero');
		$numero->setLabel('* Número: ')
					->setAttrib('size', 40)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
					
		include_once APP_PATH . "/models/Boletos.php";
		$boletosOptions = new Model_Boletos();
		$ultimonumero = $boletosOptions->fetchLastNumero();
		
		if(!$ultimonumero) $ultimonumero = 1;
		$numero->setValue($ultimonumero);
		  
		$submit = new Zend_Form_Element_Button('submitbutton');
		$submit->setLabel('Ok')
				//->setAttrib('title', 'Clique aqui para entrar após digitar seu usuário e senha')
				->setAttrib('onclick', 'javascript:_lon();saveScriptCategory();')
				->setAttrib('onmouseover', "javascript:return overlib('Click to send');")
				->setAttrib('onmouseout', 'javascript:return nd();')
				->setDecorators(array(
										'ViewHelper',
										'Description',
										'Errors', 
										array(array('data' => 'HtmlTag'), array('tag' => 'td', 'align' => 'center', 'colspan' => '2', 'id' => 'tdbuttons')),
										array(
											array('row' => 'HtmlTag'), 
											array(
												'tag' => 'tr',
												'class' => 'impar', 
												'onmouseover' => 'this.className=\'over\';', 
												'onmouseout' => 'this.className=\'impar\';'
											)
										)
									)
								);
		
		$this->addElements(array(
					$name,
					$submit,
					));
					
		if(isset($options['id']))
		{
			$id = new Zend_Form_Element_Hidden('id', array('value' => $options['id']));
			$this->addElement($id);
		}
	}
}
