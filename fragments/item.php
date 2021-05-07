<?php
/** @var rex_fragment $this
 * @var rex_dashboard_item $item
 */
$item = $this->getVar('item');
?>
<div class="grid-stack-item"<?=rex_string::buildAttributes($item->getAttributes())?>>
    <div class="grid-stack-item-content">
        <div class="panel panel-info">
            <?php if ($item->getOption('show-header')): ?>
                <header class="panel-heading">
                    <div class="panel-title"><?= htmlspecialchars($item->getName()) ?></div>
                    <?php if (rex::getUser()->hasPerm('dashboard[move-items]')): ?>
                        <div class="grid-stack-item-handle"><i class="glyphicon glyphicon-move"></i></div>
                    <?php endif; ?>
                </header>
            <?php endif; ?>
            <div class="panel-body"><?=$item->getContent() ?></div>
        </div>
    </div>
</div>
