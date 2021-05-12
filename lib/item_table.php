<?php

/**
 * @package yakamara\dashboard
 */
abstract class rex_dashboard_item_table extends rex_dashboard_item
{
    protected $tableAttributes = [
        'class' => 'bootstrap-table',
        'data-toggle' => 'table',
        'data-pagination' => 'true',
        'data-page-size' => '10',
    ];

    protected $header = [];
    protected $data = [];

    abstract protected function getTableData();
    abstract protected function getTableHeader();

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

    protected function getData()
    {
        $header = '';
        foreach ($this->getTableHeader() as $item) {
            $header .= '<th>' . htmlspecialchars($item) . '</th>';
        }

        $body = '';
        foreach ($this->getTableData() as $row) {
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
