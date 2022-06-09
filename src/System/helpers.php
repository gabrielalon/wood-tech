<?php

// PRINTERS

// prints hidden html with name of file + line from which printer was called
// use only in printers ^^ vv

use Components\Contents\Application\Content;
use Illuminate\Contracts\Container\BindingResolutionException;
use System\Illuminate\Locale;

function printCallLine(): void
{
    $dbg = debug_backtrace();
    $callPlace = $dbg[1];
    $line = $callPlace['line'] ?? '??';
    $file = $callPlace['file'] ?? '??';

    printf('<span style="display:none">%s:%d</span>'."\n", $file, $line);
}

/**
 * @param mixed $thing
 */
function __vd($thing): void
{
    ini_set('xdebug.var_display_max_depth', '-1');
    ini_set('xdebug.var_display_max_children', '-1');
    ini_set('xdebug.var_display_max_data', '-1');

    echo '<pre>';
    var_dump($thing);
    echo '</pre>';
    printCallLine();
}

/**
 * @param string $msg
 */
function kill(string $msg = ''): void
{
    echo $msg."\n";
    dbg();
    exit();
}

function dbg(): void
{
    echo get_dbg();
}

/**
 * @return string
 */
function get_dbg(): string
{
    $str = '<pre>';
    foreach (debug_backtrace() as $debugLine) {
        if (isset($debugLine['file'], $debugLine['line'])) {
            $str .= $debugLine['file'].':'.$debugLine['line']."\n";
        }
    }
    $str .= '</pre>';

    return $str;
}

// LOCALES

/**
 * @return Locale
 *
 * @throws BindingResolutionException
 */
function locale(): Locale
{
    return app()->make(Locale::class);
}

function content(): Content
{
    return app()->make(Content::class);
}
