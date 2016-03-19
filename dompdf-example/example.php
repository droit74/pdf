<?php

define ( 'ROOT_DIR', dirname ( __FILE__ ) );

define ( 'BASE_PATH', ROOT_DIR . '/template/icon');

define ( 'TEMPLATE', ROOT_DIR . '/template/main.html' );

// Подключаем файл с конфигурацией DOMPDF
require_once (ROOT_DIR . '../dompdf/autoload.inc.php');

// Загрузка шаблона
if (@file_exists(TEMPLATE) )
	$template = file_get_contents(TEMPLATE);

/*
* Номер текущей страницы 
* если требуется сгенерировать несколько документов
*/
$current_page = 1;

// Массив с метками и их значениями для шаблона
$signs = array (
	'color' => '#0080C0',
	'page-1' => 'Страница 1',
	'page-2' => 'Страница 2',
	'label-1' => 'site.com',
	'label-2' => 'info@site.com',
	'start-page' => $current_page);

// Замена меток в шаблоне их значениями
foreach ($signs as $key => $value)
	$template = str_replace('{' . $key . '}', $value, $template);	

$pdf = new DOMPDF();
// Устанавливаем путь к директории с изображениями и CSS стилями
$pdf->set_base_path(BASE_PATH);
// Загружаем шаблон
$pdf->load_html($template);
// Генерируем PDF файл
$pdf->render();
// Получаем данные в формате PDF
$data = $pdf->output();

/*
* Увеличили счетчик числа сгенерированных страниц
* на число страниц текущего документа
*/
$current_page = $current_page + $pdf->get_canvas()->get_page_count();
// Сохраняем PDF файл
file_put_contents(ROOT_DIR . "/example.pdf", $data);

?>