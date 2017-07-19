<?php
/**
 * Form to scripts
 * @copyright  2011 Luciano Marinho
 * @package    Luciano Marinho
 * @author Nick Marinho <nickmarinho@gmail.com> - 2011-09-12
 * @version    1.0  
 * @name FormScripts.php
 */
class Form_Scripts extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
		$this->setName('form_scripts')
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

		$category_id = new Zend_Form_Element_Select('category_id');
		$category_id->setLabel('* Category: ')
					->setAttrib('size', 1)
					->setDecorators($decoratorOptions);
		$category_id->addMultiOption('', '----');
		
		include_once APP_PATH . "/models/ScriptsCategories.php";
		$scriptscategoriesOptions = new Model_ScriptsCategories();
		foreach($scriptscategoriesOptions->fetchEntries() as $scriptscategories){
			$category_id->addMultiOption($scriptscategories['id'], utf8_encode(stripslashes($scriptscategories['name'])));
		}
		
		$title = new Zend_Form_Element_Text('title');
		$title->setLabel('* Title: ')
					->setAttrib('size', 85)
					->setAttrib('onchange', 'javascript:formatscriptfields();')
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);
		  
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('* Name: ')
					->setAttrib('size', 85)
					->setAttrib('onkeyup', 'javascript:loadtools();')
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$meta_keywords = new Zend_Form_Element_Text('meta_keywords');
		$meta_keywords->setLabel('* Keywords: ')
					->setAttrib('size', 85)
					->setAttrib('onchange', 'javascript:loadtools();')
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$meta_description = new Zend_Form_Element_Text('meta_description');
		$meta_description->setLabel('* Description: ')
					->setAttrib('size', 85)
					->setRequired(true)
					->addValidator('NotEmpty')
					->setDecorators($decoratorOptions);

		$content = new Zend_Form_Element_Textarea('content');
		$content->setLabel('')
					->setAttrib('cols', 83)
					->setAttrib('rows', 20)
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

		$this->addElements(array(
					$category_id,
					$title,
					$name,
					$meta_keywords,
					$meta_description,
					$content,
					$submit,
					));
					
		if(isset($options['id']))
		{
			$id = new Zend_Form_Element_Hidden('id', array('value' => $options['id']));
			$this->addElement($id);
		}
	}
}
