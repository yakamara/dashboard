<div id="rex-dashboard"><?php
$addon = rex_addon::get('dashboard');
echo rex_view::title($addon->i18n('title'), rex_dashboard::getHeader());
echo rex_dashboard::get();
?></div>
