<?php
class rex_dashboard_item_table_demo extends rex_dashboard_item_table
{
    protected $header = [];
    protected $data = [];

    protected function __construct($id, $name)
    {
        parent::__construct($id, $name);

        $data = rex_sql::factory()->setQuery('
            SELECT  id ID
                    , label Label
                    , dbtype `DB-Type`
            FROM rex_metainfo_type
            ORDER BY id ASC
        ')->getArray();

        if (!empty($data)) {
            $this->data = $data;
            $this->header = array_keys($data[0]);
        }
    }

    protected function getTableHeader()
    {
        return $this->header;
    }

    protected function getTableData()
    {
        return $this->data;
    }
}
