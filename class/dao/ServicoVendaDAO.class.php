<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-12 17:12
 */
interface ServicoVendaDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ServicoVenda 
	 */
	public function load($servicoId, $vendaId);

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
 	 * @param servicoVenda primary key
 	 */
	public function delete($servicoId, $vendaId);
	
	public function deleteVenda($vendaId);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ServicoVenda servicoVenda
 	 */
	public function insert($servicoVenda);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ServicoVenda servicoVenda
 	 */
	public function update($servicoVenda);	
	
	public function queryByVenda($id_venda);

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByQtde($value);


	public function deleteByQtde($value);


}
?>