<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-13 19:39
 */
interface ProdutoVendaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ProdutoVenda 
	 */
	public function load($produtoId, $vendaId);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	public function queryByVenda($id_venda);
	
	public function deleteVenda($vendaId);
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param produtoVenda primary key
 	 */
	public function delete($produtoId, $vendaId);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProdutoVenda produtoVenda
 	 */
	public function insert($produtoVenda);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProdutoVenda produtoVenda
 	 */
	public function update($produtoVenda);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByQtde($value);


	public function deleteByQtde($value);


}
?>