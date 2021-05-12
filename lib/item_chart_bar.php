<?php

/**
 * @package yakamara\dashboard
 */
abstract class rex_dashboard_item_chart_bar extends rex_dashboard_item_chart
{
    protected $chartType = 'bar';

    public function setHorizontal()
    {
        $this->chartOptions['indexAxis'] = 'y';
        return $this;
    }

    public function setVertical()
    {
        unset($this->chartOptions['orientation']);
        return $this;
    }
}
