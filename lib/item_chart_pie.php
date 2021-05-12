<?php

/**
 * @package yakamara\dashboard
 */
abstract class rex_dashboard_item_chart_pie extends rex_dashboard_item_chart
{
    use rex_dashboard_chart_colors;

    protected $chartType = 'pie';

    public function setDonut()
    {
        $this->chartType = 'doughnut';
        return $this;
    }
}
