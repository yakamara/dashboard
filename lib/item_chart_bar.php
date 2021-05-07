<?php

/**
 * @package yakamara\dashboard
 */
class rex_dashboard_item_chart_bar extends rex_dashboard_item_chart
{
    protected $chartType = 'bar';
    protected $orientation = 'vertical';

    /** @var array $data
     *  label => value
     * OR
     *  ['label' => label, 'value' => value]
     * OR
     *  [label, value]
     */
    public function setChartData(array $data)
    {
        parent::setChartData($data);

        if ($this->orientation === 'horizontal') {
            $this->chartData['datasets'][0]['axis'] = 'y';
            $this->setJsonOptions(['indexAxis' => 'y']);
        }

        return $this;
    }

    public function setHorizontal()
    {
        $this->orientation = 'horizontal';
        return $this;
    }

    public function setVertical()
    {
        $this->orientation = 'vertical';
        return $this;
    }
}
