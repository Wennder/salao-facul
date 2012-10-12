<?php
/**
 * Class that operate on table 'fornecedor'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2012-10-10 00:17
 */
class FornecedorMySqlDAO implements FornecedorDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return FornecedorMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM fornecedor WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM fornecedor';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM fornecedor ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param fornecedor primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM fornecedor WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param FornecedorMySql fornecedor
 	 */
	public function insert($fornecedor){
		$sql = 'INSERT INTO fornecedor (nome, endereco, email, telefone, cnpj, data) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($fornecedor->nome);
		$sqlQuery->set($fornecedor->endereco);
		$sqlQuery->set($fornecedor->email);
		$sqlQuery->set($fornecedor->telefone);
		$sqlQuery->set($fornecedor->cnpj);
		$sqlQuery->set($fornecedor->data);

		$id = $this->executeInsert($sqlQuery);	
		$fornecedor->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param FornecedorMySql fornecedor
 	 */
	public function update($fornecedor){
		$sql = 'UPDATE fornecedor SET nome = ?, endereco = ?, email = ?, telefone = ?, cnpj = ?, data = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($fornecedor->nome);
		$sqlQuery->set($fornecedor->endereco);
		$sqlQuery->set($fornecedor->email);
		$sqlQuery->set($fornecedor->telefone);
		$sqlQuery->set($fornecedor->cnpj);
		$sqlQuery->set($fornecedor->data);

		$sqlQuery->setNumber($fornecedor->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM fornecedor';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNome($value){
		$sql = 'SELECT * FROM fornecedor WHERE nome LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndereco($value){
		$sql = 'SELECT * FROM fornecedor WHERE endereco LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEmail($value){
		$sql = 'SELECT * FROM fornecedor WHERE email LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTelefone($value){
		$sql = 'SELECT * FROM fornecedor WHERE telefone LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCnpj($value){
		$sql = 'SELECT * FROM fornecedor WHERE cnpj LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByData($value){
		$sql = 'SELECT * FROM fornecedor WHERE data LIKE ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNome($value){
		$sql = 'DELETE FROM fornecedor WHERE nome = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndereco($value){
		$sql = 'DELETE FROM fornecedor WHERE endereco = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEmail($value){
		$sql = 'DELETE FROM fornecedor WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTelefone($value){
		$sql = 'DELETE FROM fornecedor WHERE telefone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCnpj($value){
		$sql = 'DELETE FROM fornecedor WHERE cnpj = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByData($value){
		$sql = 'DELETE FROM fornecedor WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return FornecedorMySql 
	 */
	protected function readRow($row){
		$fornecedor = new Fornecedor();
		
		$fornecedor->id = $row['id'];
		$fornecedor->nome = $row['nome'];
		$fornecedor->endereco = $row['endereco'];
		$fornecedor->email = $row['email'];
		$fornecedor->telefone = $row['telefone'];
		$fornecedor->cnpj = $row['cnpj'];
		$fornecedor->data = $row['data'];

		return $fornecedor;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return FornecedorMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>