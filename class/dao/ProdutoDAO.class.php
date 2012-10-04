<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-04 11:57
 */
interface ProdutoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Produto 
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
 	 * @param produto primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Produto produto
 	 */
	public function insert($produto);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Produto produto
 	 */
	public function update($produto);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDescricao($value);

	public function queryByQtdeEstoque($value);

	public function queryByQtdeUltimaCompra($value);

	public function queryByValorUnitario($value);

	public function queryByMarca($value);

	public function queryByData($value);


	public function deleteByDescricao($value);

	public function deleteByQtdeEstoque($value);

	public function deleteByQtdeUltimaCompra($value);

	public function deleteByValorUnitario($value);

	public function deleteByMarca($value);

	public function deleteByData($value);


}
?>