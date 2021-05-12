<?php

class rex_api_dashboard_get extends rex_api_function
{
    protected $published = false;

    function execute()
    {
        if (!($user = rex::getUser())) {
            return new rex_api_result(false, rex_i18n::msg('dashboard_api_get_failed_user'));
        }

        $ids = rex_request('ids', 'array', []);
        $result = [];
        foreach (rex_dashboard::getItems($ids) as $item) {
            $result[$item->getId()] = $item
                ->useCache(false)
                ->getContent()
            ;
        }

        echo json_encode(count($result) === 1 ? $result[array_key_first($result)] : $result);
        exit;
        // return new rex_api_result(true, json_encode($result));
    }
}
