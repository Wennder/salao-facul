<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-04 11:57
 */
interface ConfiguracaoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Configuracao 
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
 	 * @param configuracao primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Configuracao configuracao
 	 */
	public function insert($configuracao);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Configuracao configuracao
 	 */
	public function update($configuracao);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNomeEmpresa($value);

	public function queryByTelefone($value);

	public function queryByEmail($value);

	public function queryByPercentualPadrao($value);


	public function deleteByNomeEmpresa($value);

	public function deleteByTelefone($value);

	public function deleteByEmail($value);

	public function deleteByPercentualPadrao($value);


}
?>