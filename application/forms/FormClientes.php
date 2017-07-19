<?php
/**
 * Form to clientes
 * @copyright  2011 Luciano Marinho
 * @package    Luciano Marinho
 * @author Nick Marinho <nickmarinho@gmail.com> - 2011-09-16
 * @version    1.0  
 * @name FormClientes.php
 */
class Form_Clientes extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
		$this->setName('form_clientes')
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

		$nome = new Zend_Form_Element_Text('nome');
		$nome->setLabel('* Nome: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$tipo = new Zend_Form_Element_Select('tipo');
		$tipo->setLabel('* Tipo: ')
					->setAttrib('size', 1)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		$tipo->addMultiOptions(array('f' => 'Física','j' => 'Jurídica'));
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('* Email: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		
		$cpfcnpj = new Zend_Form_Element_Text('cpfcnpj');
		$cpfcnpj->setLabel('Cpf/Cnpj: ')
					->setAttrib('size', 85)
					->setAttrib('maxlength', 18)
					->setAttrib('onkeyup', "javascript:mascaracpf('cpfcnpj');")
					->setRequired(false)
					->setDecorators($decoratorOptions);

		$hospedagem = new Zend_Form_Element_Text('hospedagem');
		$hospedagem->setLabel('* Hospedagem: ')
					->setAttrib('size', 85)
					->setAttrib('onkeyup', 'javascript:loadtools();')
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$endereco1 = new Zend_Form_Element_Text('endereco1');
		$endereco1->setLabel('* Endereco1: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$endereco2 = new Zend_Form_Element_Text('endereco2');
		$endereco2->setLabel('* Endereco2: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$demonstrativo1 = new Zend_Form_Element_Text('demonstrativo1');
		$demonstrativo1->setLabel('* Demonstrativo1: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$demonstrativo2 = new Zend_Form_Element_Text('demonstrativo2');
		$demonstrativo2->setLabel('* Demonstrativo2: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$instrucao1 = new Zend_Form_Element_Text('instrucao1');
		$instrucao1->setLabel('* Instrucao1: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$instrucao2 = new Zend_Form_Element_Text('instrucao2');
		$instrucao2->setLabel('* Instrucao2: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$instrucao3 = new Zend_Form_Element_Text('instrucao3');
		$instrucao3->setLabel('* Instrucao3: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$submit = new Zend_Form_Element_Submit('submitbutton');
		$submit->setLabel('Ok')
				->setAttrib('class', "button openmodalbox")
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

		$this->addElements(array($nome,
								$tipo,
								$email,
								$cpfcnpj,
								$hospedagem,
								$endereco1,
								$endereco2,
								$demonstrativo1,
								$demonstrativo2,
								$instrucao1,
								$instrucao2,
								$instrucao3,
								$submit));
					
		if(isset($options['id']))
		{
			$id = new Zend_Form_Element_Hidden('id', array('value' => $options['id']));
			$this->addElement($id);
		}
	}
}
