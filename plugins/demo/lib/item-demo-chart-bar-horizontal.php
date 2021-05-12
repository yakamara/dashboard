<?php
class rex_dashboard_item_chart_bar_horizontal extends rex_dashboard_item_chart_bar
{
    protected function __construct($id, $name)
    {
        parent::__construct($id, $name);
        $this->setHorizontal();
    }

    public function getChartData()
    {
        return [
            'Rot' => 12,
            'Blau' => 19,
            'Gelb' => 3,
            'Grün' => 5,
            'Lila' => 2,
            'Orange' => 3,
        ];
    }
}
