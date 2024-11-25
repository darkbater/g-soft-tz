<?php
class app{
	/**
	 * Получение главной страницы пользователя
	 */
	function main(){
	
	}
	/**
	 * Получение информации о клиенте
	 */
	function client_info_page($id){
		}
	/**
	 * Получение информации о менеджере
	 */
	function manager_info_page($id){
    
		}
	/**
	 * Страница создания заявки
	 */
	function new_cargo_page(){
		}
	/**
	 * Страница редактирования заявки
	 */
	function edit_cargo_page($id){
		}
	/**
	 * Список клиентов, для авторизации
	 */
	function clients_list(){
		}
	/**
	 * Список менеджеров, для авторизации
	 */
	function managers_list(){
		}

	/**
	* Конструктор, подключение к БД
	*/
	public function __construct($db_config) {
		$this->db = new mysqli(...$db_config);
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
			} else echo "Connection complete.";
		}
	}

