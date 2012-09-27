<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return ClienteDAO
	 */
	public static function getClienteDAO(){
		return new ClienteMySqlExtDAO();
	}

	/**
	 * @return CompraDAO
	 */
	public static function getCompraDAO(){
		return new CompraMySqlExtDAO();
	}

	/**
	 * @return DespesaDAO
	 */
	public static function getDespesaDAO(){
		return new DespesaMySqlExtDAO();
	}

	/**
	 * @return FornecedorDAO
	 */
	public static function getFornecedorDAO(){
		return new FornecedorMySqlExtDAO();
	}

	/**
	 * @return FuncionarioDAO
	 */
	public static function getFuncionarioDAO(){
		return new FuncionarioMySqlExtDAO();
	}

	/**
	 * @return ProdutoDAO
	 */
	public static function getProdutoDAO(){
		return new ProdutoMySqlExtDAO();
	}

	/**
	 * @return UsuarioDAO
	 */
	public static function getUsuarioDAO(){
		return new UsuarioMySqlExtDAO();
	}

	/**
	 * @return UtensilioDAO
	 */
	public static function getUtensilioDAO(){
		return new UtensilioMySqlExtDAO();
	}


}
?>