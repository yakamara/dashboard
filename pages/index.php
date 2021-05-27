<?php

$addon = rex_addon::get('dashboard');
echo rex_view::title(rex_dashboard::getHeader() . $addon->i18n('title'));
echo '<div id="rex-dashboard">'.rex_dashboard::get().'</div>';

?>