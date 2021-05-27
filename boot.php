<?php

$addon = rex_addon::get('dashboard');

if (rex::isBackend()) {
    // register dashboard items
    rex_extension::register(
        'PACKAGES_INCLUDED',
        static function () {
            rex_dashboard::init();
        }, rex_extension::LATE
    );

    rex_perm::register('dashboard[move-items]', null, rex_perm::EXTRAS);

    if ('dashboard' == rex_be_controller::getCurrentPagePart(1)) {
        rex_view::addCssFile($addon->getAssetsUrl('css/style.css'));
        rex_view::addJsFile($addon->getAssetsUrl('js/script.js'));
    }
}
