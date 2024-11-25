<?php declare(strict_types=1);
$config = include "{$_SERVER['DOCUMENT_ROOT']}/config.php";
include "app.php";
$app = new app($config);

/**
 * Отладка
 */
// echo "<br><pre>";
// print_r($_POST);
// print_r($_SESSION);
// echo "</pre>";

// Если пришел запрос на выход
if(isset($_POST['exit'])){
	$app->exit();
}

// Если пришла форма авторизации
if(isset($_POST['auth'])){
	$app->auth();
	}
// Проверка "авторизованности"
if(!isset($_SESSION['type'])){
	// Если нет - выводим форму авторизации
	$app->auth_form();
	} else { // Если да - кнопку выхода
	$app->exit_form();
	}

if(isset($_POST['cargo'])){
	$app->new_cargo();
	}

/**
 * Проверяем авторизованы ли.
 * Если нет - открываем авторизацию.
 * Если да -
 * 	смотрим не открыты ли вспомогательные страницы?
 *  если да - открываем соответствующую страницу
 *  если нет - открываем главную страницу
 * 
 */

// echo $_
// print_r($_GET);
// Коммутатор страниц
switch (@$_GET['page']) {
	// Страница добавления груза клиентом
	case 'add':
		# code...
		echo "Страница добавления заказа<br>";
		$app->new_cargo_page();
		break;
	// Страница приёма груза менеджером
	case 'apply':
		# code...
		echo "Страница новых зявок<br>";
		$app->apply_cargo_page();
		break;
	default:
		echo "aaa";
		# Основная страница
		// Если не выбрана служебная страница - выводим основную таблицу приложения
		
		$app->main();
		break;
	}
 echo "bbb";