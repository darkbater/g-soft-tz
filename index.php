<?php declare(strict_types=1);
$config = include "{$_SERVER['DOCUMENT_ROOT']}/config.php";
include "app.php";
$app = new app($config);

/**
 * Отладка
 */
echo "<br><pre>";
print_r($_POST);
print_r($_SESSION);
echo "</pre>";

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



/**
 * Проверяем авторизованы ли.
 * Если нет - открываем авторизацию.
 * Если да -
 * 	смотрим не открыты ли вспомогательные страницы?
 *  если да - открываем соответствующую страницу
 *  если нет - открываем главную страницу
 * 
 */


switch (true) {
	case @$_SERVER['page'] == 'new':
		# code...
		break;
	case @$_SERVER['page'] == 'edit':
		# code...
		break;
	default:
		# Основная страница
		
		break;
 }