<div id="rex-dashboard-settings">
    <ul class="actions">
        <li id="rex-dashboard-refresh" title="<?=rex_i18n::msg('dashboard_action_refresh') ?>">
            <i class="glyphicon glyphicon-refresh"></i>
            <span><?=rex_i18n::msg('dashboard_action_refresh') ?></span>
        </li>
        <?php /*<li id="rex-dashboard-compact" title="<?=rex_i18n::msg('dashboard_action_compact') ?>">
            <i class="glyphicon glyphicon-equalizer"></i>
            <span><?=rex_i18n::msg('dashboard_action_compact') ?></span>
        </li>
        <li id="rex-dashboard-autosize" title="<?=rex_i18n::msg('dashboard_action_autosize') ?>">
            <i class="glyphicon glyphicon-fullscreen"></i>
            <span><?=rex_i18n::msg('dashboard_action_autosize') ?></span>
        </li>*/ ?>
    </ul>
    <?=$this->getVar('widgetSelect') ?>
</div>
