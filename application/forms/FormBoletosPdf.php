<?php
/**
 * Form to Boletos Pdf
 * @copyright  2011 Luciano Marinho
 * @package    Luciano Marinho
 * @author Nick Marinho <nickmarinho@gmail.com> - 2011-09-20
 * @version    1.0  
 * @name FormBoletosPdf.php
 */
class Form_BoletosPdf extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
		$this->setName('form_boletospdf')
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

		$id_banco = new Zend_Form_Element_Select('id_banco');
		$id_banco->setLabel('* Banco: ')
					->setAttrib('size', 5)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		
		include_once APP_PATH . "/models/Bancos.php";
		$bancosOptions = new Model_Bancos();
		$id_banco->addMultiOption('', '-- selecione --');
		foreach($bancosOptions->fetchEntries() as $bancos){
			$id_banco->addMultiOption($bancos['id'], utf8_encode(stripslashes($bancos['nome'])));
		}

		$tipo = new Zend_Form_Element_Hidden('tipo');
		$tipo->setLabel('')->setDecorators($decoratorOptions);
		  
		$submit = new Zend_Form_Element_Button('submitbutton');
		$submit->setLabel('Gerar PDF')
				->setAttrib('class', "button openmodalbox")
				->setAttrib('onclick', "exportpdfaction('boletos', '1');")
				->setAttrib('title', 'Gerar PDF')
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
					$id_banco,
					$submit,
					));

		if(isset($options['id_boleto']))
		{
			$id_boleto = new Zend_Form_Element_Hidden('id_boleto', array('value' => $options['id_boleto']));
			$this->addElement($id_boleto);
		}
	}
}
