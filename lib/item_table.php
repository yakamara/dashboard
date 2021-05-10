<?php

/**
 * @package yakamara\dashboard
 */
class rex_dashboard_item_table extends rex_dashboard_item
{
    protected $tableAttributes = [
        'class' => 'bootstrap-table',
        'data-toggle' => 'table',
        'data-pagination' => 'true',
        'data-page-size' => '10',
    ];

    protected $header = [];
    protected $data = [];

    protected function __construct($id, $name)
    {
        static::addJs(rex_addon::get('dashboard')->getAssetsUrl('js/table.min.js'), 'table.js');
        static::addJs(rex_addon::get('dashboard')->getAssetsUrl('js/table.locale.min.js'), 'table.locale.js');
        parent::__construct($id, $name);
    }

    public function setTableAttribute($key, $value)
    {
        $this->tableAttributes[$key] = $value;
        return $this;
    }

    public function setTableData(array $data, $firstColumnisHeader = true)
    {
        if ($firstColumnisHeader) {
            $this->setTableHeader($data[array_key_first($data)]);
            unset($data[array_key_first($data)]);
        }

        $this->data = $data;
        return $this;
    }

    public function setTableHeader(array $data)
    {
        $this->header = $data;
        return $this;
    }

    public function setTableDataSql($query)
    {
        $data = rex_sql::factory()->setQuery($query)->getArray();

        if (!empty($data)) {
            $this->data = $data;
            $this->setTableHeader(array_keys($data[0]));
        }

        return $this;
    }

    public function getContent()
    {
        $header = '';
        foreach ($this->header as $item) {
            $header .= '<th>' . htmlspecialchars($item) . '</th>';
        }

        $body = '';
        foreach ($this->data as $row) {
            $body .= '<tr>';
            foreach ($row as $item) {
                $body .= '<td>'.htmlspecialchars($item).'</td>';
            }
            $body .= '</tr>';
        }

        return '<table' . rex_string::buildAttributes($this->tableAttributes) . '>
    <thead><tr>' . $header . '</tr></thead>
    <tbody>' . $body . '</tbody>
</table>';
    }
}
