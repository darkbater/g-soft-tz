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
	 * Селектор клиентов, для авторизации
	 */
	function clients_list(){
		$select = "<select name='client'>";
		$select .= "<option></option>";
		
		$res = $this->db->query('select * from `clients`');
		while ($row = $res -> fetch_assoc()) {
			$select.="<option value='{$row['id']}'>{$row['company']}</option>";
			// print_r($row);
			// echo "<br>";
		}
		$select .= "</select>";
		echo $select;
	}
	/**
	 * Селектор менеджеров, для авторизации
	 */
	function managers_list(){
		$select = "<select name='manager'>";
		$select .= "<option></option>";
	
		$res = $this->db->query('select * from `managers`');
		while ($row = $res -> fetch_assoc()) {
			$select.="<option value='{$row['id']}'>{$row['surname']}</option>";
			// print_r($row);
			// echo "<br>";
		}
		$select .= "</select>";
		echo $select;
	}

	/**
	 * Форма авторизации
	 */
	function auth_form(){
		echo "Требуется авторизация<br>";
		echo "<form method=post name=auth>";
		$this->clients_list();
		echo "<br>";
		$this->managers_list();
		echo "<br>";
		echo "<input type='submit' name=auth>";
		die("</form>");
	}
	/**
	 * Форма выхода
	 */
	function exit_form(){
		echo "<form method=post name=exit>";
		echo "<input type='submit' name=exit value='exit'>";
		echo "</form>";
	}

	/**
	 * Механизм авторизации
	 */
	function auth(){
		echo "<br><b>Происходит авторизация</b><br>";
		$post = array_filter($_POST);
		if(isset($post['client'])){
			echo "<br>Авторизован клиент<br>";
			session_start();
			$_SESSION['type'] = 'client';
			$_SESSION['id'] = $post['client'];
			session_write_close();
			header('Location:/');
		}
		if(isset($post['manager'])){
			echo "<br>Авторизован менеджер<br>";
			session_start();
			$_SESSION['type'] = 'manager';
			$_SESSION['id'] = $post['manager'];
			session_write_close();
		header('Location:/');
			}
		// session_commit();
		// echo "post:<br>";
		// print_r($post);
		// echo "session:<br>";
		// print_r($_SESSION);	
	}
	/**
	 * Механизм выхода
	 */
	function exit(){
		echo "Выходим<br>";
		session_start();
		unset($_SESSION['type']);
		unset($_SESSION['id']);
		session_write_close();
		header('Location:/');
		}

	/**
	* Конструктор, подключение к БД
	*/
	public function __construct($db_config) {
		$this->db = new mysqli(...$db_config);
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
			};// else echo "Connection complete.";
		if (session_status() != PHP_SESSION_ACTIVE) {
			session_start([
					'cookie_lifetime' => 86400,
					'read_and_close'  => true,
					]);
			} else die("Sessions not supported");
			
		}
	}

