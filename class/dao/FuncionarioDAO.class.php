<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-08 23:22
 */
interface FuncionarioDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Funcionario 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param funcionario primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Funcionario funcionario
 	 */
	public function insert($funcionario);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Funcionario funcionario
 	 */
	public function update($funcionario);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNome($value);

	public function queryByEndereco($value);

	public function queryByCpf($value);

	public function queryByRg($value);

	public function queryByTelefone($value);

	public function queryByCargo($value);

	public function queryByDataAdmissao($value);

	public function queryByObs($value);


	public function deleteByNome($value);

	public function deleteByEndereco($value);

	public function deleteByCpf($value);

	public function deleteByRg($value);

	public function deleteByTelefone($value);

	public function deleteByCargo($value);

	public function deleteByDataAdmissao($value);

	public function deleteByObs($value);


}
?>