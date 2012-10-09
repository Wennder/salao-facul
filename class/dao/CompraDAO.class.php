<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-08 23:22
 */
interface CompraDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Compra 
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
 	 * @param compra primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Compra compra
 	 */
	public function insert($compra);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Compra compra
 	 */
	public function update($compra);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDescricao($value);

	public function queryByTotal($value);

	public function queryByQtde($value);

	public function queryByNumeroNotaFiscal($value);

	public function queryByVencimento($value);

	public function queryByNomeRepresentante($value);

	public function queryByData($value);


	public function deleteByDescricao($value);

	public function deleteByTotal($value);

	public function deleteByQtde($value);

	public function deleteByNumeroNotaFiscal($value);

	public function deleteByVencimento($value);

	public function deleteByNomeRepresentante($value);

	public function deleteByData($value);


}
?>