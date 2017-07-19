<?php 
/**
 * Model bancos
 * @copyright  2011 Luciano Marinho
 * @package    Luciano Marinho
 * @author Nick Marinho <nickmarinho@gmail.com> - 2011-09-17
 * @version    1.0 
 * @name Bancos.php
 */
class Model_Bancos
{
	protected $_table;
	
	/**
	* incluir nova linha
	*
	* garante que um timestamp seja configurado para o campo created
	*
	* @param array $data
	* @return int
	*/
	public function getTable()
	{
		// this is singleton
		if(null === $this->_table)
		{
			/**
			* uma vez que a tabela do banco não é um item da biblioteca e sim da aplicacao, devemos forçar seu uso
			*/
			require_once APP_PATH . '/models/DbTable/Bancos.php';
			$this->_table = new Model_DbTable_Bancos();
		}
		
		return $this->_table;
	}
	
	/**
	* grava nova entrada
	*
	* @param array $data
	* @return int|string
	*/
	public function save(array $data)
	{
		$table = $this->getTable();
		$fields = $table->info(Zend_Db_Table_Abstract::COLS);
		
		foreach($data as $field => $value)
		{
			if(!in_array($field, $fields))
			{
				unset($data[$field]);
			}
		}
		
		return $table->insert($data);
	}
	
	/**
	* atualiza entrada
	*
	* @param array $data
	*/
	public function update(array $data, $id)
	{
		$table = $this->getTable();
		$fields = $table->info(Zend_Db_Table_Abstract::COLS);
		
		foreach($data as $field => $value)
		{
			if(!in_array($field, $fields))
			{
				unset($data[$field]);
			}
		}
		
		return $table->update($data, "id = $id");
	}
	
	/**
	* remove entrada
	*
	* @param $id
	* @return true|false
	*/
	public function delete($id)
	{
		$table = $this->getTable();
		return $table->delete("id = $id");
	}
	
	/**
	* traz todas entradas
	*
	* @return Zend_Db_Table_Rowset_Abstract
	*/
	public function fetchEntries($options=null)
	{
		$table = $this->getTable();
		$select = $table
			->select()
			->setIntegrityCheck(false)
			->from($table, array('*'));
		if(count($options) > 0)
		{
			$where = "1 ";
			foreach($options[0] as $key => $value){ $where .= " AND " . $key . " LIKE '%" . $value . "%' "; }
			$select->where($where);
		}
		
		$select->order('cdate DESC');
		
		return $table->fetchAll($select)->toArray();
	}
	
	/**
	* traz todas entradas
	*
	* @return Zend_Db_Table_Rowset_Abstract
	*/
	public function fetchFrontEntries($options=null)
	{
		$table = $this->getTable();
		$select = $table
			->select()
			->setIntegrityCheck(false)
			->from($table, array('*'));
		if(count($options) > 0)
		{
			$where = "1 ";
			foreach($options[0] as $key => $value){ $where .= " AND " . $key . " LIKE '%" . $value . "%' "; }
			$select->where($where);
		}
		
		$select->where(" blog.display='1' ");
		$select->order('cdate DESC');
		
		return $table->fetchAll($select)->toArray();
	}
	
	/**
	* traz entrada de acordo com o id passado
	*
	* @param int|string $id
	* @return null|Zend_Db_Table_Rowset_Abstract
	*/
	public function fetchEntryByUrl($url)
	{
		$table = $this->getTable();
		$select = $table->select()->where('url = ?',$url);
		
		return $table->fetchRow($select)->toArray();
	}
	
	/**
	* traz entrada de acordo com o id passado
	*
	* @param int|string $id
	* @return null|Zend_Db_Table_Rowset_Abstract
	*/
	public function fetchEntry($id)
	{
		$table = $this->getTable();
		$select = $table->select()->where('id = ?',$id);
		
		return $table->fetchRow($select)->toArray();
	}
}
?>
