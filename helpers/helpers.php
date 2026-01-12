<?php

use JetBrains\PhpStorm\NoReturn;

function app(): \PHPFrw\Application
{
    return \PHPFrw\Application::$app;
}

function request(): \PHPFrw\Request
{
    return app()->request;
}

function response(): \PHPFrw\Response
{
    return app()->response;
}

function session(): \PHPFrw\Session
{
    return app()->session;
}

function cache(): \PHPFrw\Cache
{
    return app()->cache;
}

function router(): \PHPFrw\Router
{
    return app()->router;
}

function get_route_params(): array
{
    return router()->getRouteParams();
}

function get_route_param($key, $default=''): string
{
    return router()->getRouteParams()[$key] ?? $default;
}

function array_value_search($arr, $index, $value): int|string|null
{
    foreach ($arr as $k => $v) {
        if ($v[$index] == $value){
            return $k;
        }
    }
    return null;
}

function db(): \PHPFrw\DataBase
{
    return app()->db;
}

function view($view = '', $data = [], $layout=''): string|\PHPFrw\View
{
    if($view){
        return app()->view->render($view,$data, $layout);
    }
    return app()->view;
}

#[NoReturn] function abort($error = '', $code = 404): void
{
    if (APP_DEBUG !== true) {
        response()->setResponseCode($code);
        echo view("errors/{$code}", ['error' => $error], false);
        die;
    }
}

function base_url($path=''): string
{
    return PATH_URL.$path;
}

function get_alerts(): void
{
    if (!empty($_SESSION['flash'])){
        foreach ($_SESSION['flash'] as $k => $v) {
            echo view()->renderPartial(
                "incs/alert_{$k}",
                ["flash_{$k}" => session()->getFlash($k)]
            );
        }
    }
}

function get_errors($fieldName): string
{
    $output = '';
    $errors = session()->get('form_errors');
    if (isset($errors[$fieldName])) {
        $output .= '<div class="invalid-feedback d-block"><ul class="list-unstyled">';
        foreach ($errors[$fieldName] as $error ) {
            $output .= "<li>$error</li>";
        }
        $output .= '</ul></div>';
    }
    return $output;
}

function get_validation_class($fieldName): string
{
    $errors = session()->get('form_errors');
    if (empty($errors)){
        return '';
    }
    return isset($errors[$fieldName]) ? 'is-invalid' : 'is-valid';
}

function old($fieldName): string
{
    return isset(session()->get('form_data')[$fieldName]) ?
        h(session()->get('form_data')[$fieldName]) : '';
}

function h($str): string
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function get_csrf_token(): string
{
    return '<input type="hidden" name="csrf_token" value="'. session()->get('csrf_token') .'">';
}

function get_csrf_meta(): string
{
    return '<meta name="csrf-token" content="'. session()->get('csrf_token') .'">';
}

function check_auth(): bool
{
    return \PHPFrw\Auth::isAuth();
}

function getUser()
{
    return \PHPFrw\Auth::user();
}

function formOldCheckbox($publish='')
{
    return $publish ? 'checked="checked"' : '';
}

function formOldSelect($category_id, $work='')
{
    if ($work){
        return $category_id == $work['category_id'] ? 'selected' : '';
    }
    return '';
}

/**
 * Загружает переменные из .env и преобразует их в PHP-константы
 * @param string $filePath Путь к файлу .env
 * @throws RuntimeException Если файл не найден или ошибка чтения
 */
function loadEnvAsConstants(string $filePath): void
{
    // Проверка существования файла
    if (!file_exists($filePath)) {
        throw new RuntimeException(sprintf('Файл .env не найден: %s', $filePath));
    }

    // Чтение строк с фильтрацией пустых и комментариев
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        throw new RuntimeException(sprintf('Не удалось прочитать файл: %s', $filePath));
    }

    foreach ($lines as $line) {
        $line = trim($line);

        // Пропускаем комментарии и пустые строки
        if ($line === '' || strpos($line, '#') === 0 || strpos($line, ';') === 0) {
            continue;
        }

        // Разделяем ключ и значение (только по первому знаку =)
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            error_log(sprintf('Пропущена некорректная строка в .env: %s', $line));
            continue;
        }

        $key = trim($parts[0]);
        $value = trim($parts[1]);

        // Удаляем кавычки (одинарные и двойные)
        if (is_string($value) && $value !== '') {
            $firstChar = $value[0];
            $lastChar  = $value[strlen($value) - 1];

            if (($firstChar === '"' && $lastChar === '"') ||
                ($firstChar === "'" && $lastChar === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        // Экранирование: \n → LF, \t → TAB и т.д.
        $value = str_replace(['\\n', '\\r', '\\t', '\\0', '\\\''], ["\n", "\r", "\t", "\0", "'"], $value);

        // Приведение типов (опционально)
        if (is_numeric($value)) {
            $value = $value + 0; // Преобразуем в число (int/float)
        } elseif (strtolower($value) === 'true') {
            $value = true;
        } elseif (strtolower($value) === 'false') {
            $value = false;
        } elseif (strtolower($value) === 'null') {
            $value = null;
        }

        // Определяем константу, только если её ещё нет
        if (!defined($key)) {
            define($key, $value);
            // Для отладки (можно убрать)
            error_log(sprintf('Определена константа: %s = %s', $key, json_encode(constant($key))));
        } else {
            error_log(sprintf('Константа %s уже существует, пропуск', $key));
        }
    }
}

try {
    loadEnvAsConstants(ROOT . '/.env');
} catch (RuntimeException $e) {
    error_log("[" . date('Y-m-d H:i:s') . "] Server Error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
    abort('Contact with administrator', 500);
    exit(1);
}