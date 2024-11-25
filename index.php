<?php declare(strict_types=1);
$config = include "{$_SERVER['DOCUMENT_ROOT']}/config.php";
include "app.php";
$app = new app($config);
if (session_status() != PHP_SESSION_ACTIVE) {
	session_start([
			'cookie_lifetime' => 86400,
			'read_and_close'  => true,
			]);
	} else die("Sessions not supported");



/**
 * Проверяем авторизованы ли.
 * Если нет - открываем авторизацию.
 * Если да -
 * 	смотрим не открыты ли вспомогательные страницы?
 *  если да - открываем соответствующую страницу
 *  если нет - открываем главную страницу
 * 
 */

// Проверка "авторизованности"
if(@$_SESSION['auth'] !== true){
	// Если не авторизованы - тогда даём выбрать вариант авторизации пользователя или менеджера
	// -- выбор:
	
	}

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