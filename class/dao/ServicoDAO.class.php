<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-10 00:17
 */
interface ServicoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Servico 
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
 	 * @param servico primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Servico servico
 	 */
	public function insert($servico);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Servico servico
 	 */
	public function update($servico);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDescricao($value);

	public function queryByHoras($value);

	public function queryByValor($value);


	public function deleteByDescricao($value);

	public function deleteByHoras($value);

	public function deleteByValor($value);


}
?>