<?php

class rex_api_dashboard_store extends rex_api_function
{
    protected $published = false;

    function execute()
    {
        if (!($user = rex::getUser())) {
            return new rex_api_result(false, rex_i18n::msg('dashboard_api_store_failed_user'));
        }

        $data = rex_request('data', 'array', []);

        // validate
        $storeData = rex_config::get('dashboard', 'items_' . $user->getId(), []);
        foreach ($data as $id => $itemData) {
            if (!rex_dashboard::itemExists($id)) {
                continue;
            }

            foreach (rex_dashboard_item::ATTRIBUTES as $attribute) {
                $storeData[$id][$attribute] = intval($itemData[$attribute] ?? 0);
            }
        }

        rex_config::set('dashboard', 'items_' . $user->getId(), $storeData);

        return new rex_api_result(true, rex_i18n::msg('dashboard_api_store_success'));
    }
}
