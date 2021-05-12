<?php

class rex_api_dashboard_get extends rex_api_function
{
    protected $published = false;

    function execute()
    {
        if (!($user = rex::getUser())) {
            return '[]';
        }

        $ids = rex_request('ids', 'array', []);
        $result = [];
        foreach (rex_dashboard::getItems($ids) as $item) {
            $result[$item->getId()] = $item
                ->useCache(false)
                ->getContent()
            ;
        }

        echo json_encode($result);
        exit;
        // return new rex_api_result(true, json_encode($result));
    }
}
