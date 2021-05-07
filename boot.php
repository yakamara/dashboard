<?php
$addon = rex_addon::get('dashboard');

if (rex::isBackend()) {
    // register dashboard items
    rex_extension::register(
        'PACKAGES_INCLUDED',
        static function () {
            rex_dashboard::init();
        }
    );

    rex_view::addCssFile($addon->getAssetsUrl('css/style.css'));
    rex_view::addJsFile($addon->getAssetsUrl('js/script.js'));
}
