<?php
class app{
	/**
	 * Получение главной страницы пользователя
	 */
	function main(){

		// Если это клиент - подключаем страницу добавления заказа
		if($_SESSION['type'] === 'client'){
			echo "<br><a href='?page=add'>Добавить заказ</a><br>";
			// $res = $this->db->query("select * from `cargo`;");
			$res = $this->db->query("select * from `cargo` where `client_id`={$_SESSION['id']};");
			}

		if($_SESSION['type'] === 'manager'){
			echo "<br><a href='?page=apply'>Новые грузы</a><br>";
			$res = $this->db->query("select * from `cargo` where `manager_id`={$_SESSION['id']};");
		
			}

		$table = "<table><tbody>";
		while($row = $res->fetch_assoc()){
			if(!isset($row['manager']))$row['manager'] = 'Не назначен';
			switch ($row['status']) {
			case 0:
				$row['status']='awaiting';
				break;
			case 1:
				$row['status']='on board';
				break;
			case 2:
				$row['status']='finished';
				break;
			}
			$table .= "<tr>
			<td>{$row['id']}
			<td>{$row['container']}
			<td>{$row['manager']}
			<td>{$row['status']}
			<td>{$row['date_arrival']}
			</tr>";
			}


		$table .= "</tbody></table>";
		die($table);
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
	 * Создание заявки
	 */
	function new_cargo(){
		$this->db->query("insert into `cargo`(`container`,`client_id`)
								values('{$_POST['cargo']}', '{$_SESSION['id']}')");
		header('Location:/');
		// die();
		}
	/**
	 * Страница приёма заявок
	 */
	function apply_cargo_page(){
		


		$res = $this->db->query("select * from `cargo` where ISNULL(`manager_id`);");
		
		$table = "<table><tbody>";
		while($row = $res->fetch_assoc()){
			if(!isset($row['manager']))$row['manager'] = 'Не назначен';
			switch ($row['status']) {
			case 0:
				$row['status']='awaiting';
				break;
			case 1:
				$row['status']='on board';
				break;
			case 2:
				$row['status']='finished';
				break;
			}
			$table .= "<tr>
			<td>{$row['id']}
			<td>{$row['container']}
			<td>{$row['manager']}
			<td>{$row['status']}
			<td>{$row['date_arrival']}
			</tr>";
			}



		die($table);
		}
	/**
	 * Страница создания заявки
	 */
	function new_cargo_page(){
		echo "<form method=post name=new_cargo action='/'>";
		echo "<input name=cargo placeholder='Конейнер' required>";
		echo "<input type='submit'>";
		echo "</form>";


		die();
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
		echo "Для клиента:";
		$this->clients_list();
		echo "<br>";
		echo "Для менеджера:";
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

