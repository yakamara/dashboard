<?php

/**
 * @package yakamara\dashboard
 */
class rex_dashboard
{
    private static ?self $instance = null;

    /** @var rex_dashboard_item[] $items */
    static $items = [];

    private function __construct()
    {

    }

    public static function init()
    {
        if (is_null(static::$instance)) {
            static::$instance = new self();
        }

        foreach (rex_dashboard_item::getCssFiles() as $filename) {
            rex_view::addCssFile($filename);
        }

        foreach (rex_dashboard_item::getJsFiles() as $filename) {
            rex_view::addJsFile($filename);
        }
    }

    public static function get()
    {
        $output = '';
        foreach (static::$items as $item) {
            $output .= (new rex_fragment(['item' => $item]))->parse('item.php');
        }

        return (new rex_fragment(['output' => $output]))->parse('dashboard.php');
    }

    public static function addItem(rex_dashboard_item $item)
    {
        static::$items[] = $item;
    }

    public static function getHeader()
    {
        return (new rex_fragment())->parse('header.php');
    }

    public static function itemExists($id)
    {
        foreach (static::$items as $item) {
            if ($item->getId() === $id) {
                return true;
            }
        }

        return false;
    }
}
