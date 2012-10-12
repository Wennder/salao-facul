<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2012-10-12 17:12
 */
interface FornecedorDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Fornecedor 
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
 	 * @param fornecedor primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Fornecedor fornecedor
 	 */
	public function insert($fornecedor);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Fornecedor fornecedor
 	 */
	public function update($fornecedor);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByNome($value);

	public function queryByEndereco($value);

	public function queryByEmail($value);

	public function queryByTelefone($value);

	public function queryByCnpj($value);

	public function queryByData($value);


	public function deleteByNome($value);

	public function deleteByEndereco($value);

	public function deleteByEmail($value);

	public function deleteByTelefone($value);

	public function deleteByCnpj($value);

	public function deleteByData($value);


}
?>