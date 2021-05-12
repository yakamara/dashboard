<?php

/**
 * @package yakamara\dashboard
 */
abstract class rex_dashboard_item_chart extends rex_dashboard_item
{
    use rex_dashboard_chart_colors;

    protected $chartData = [];
    protected $chartType = '';
    protected $chartOptions = [];

    abstract protected function getChartData();

    protected function __construct($id, $name)
    {
        static::addJs(rex_addon::get('dashboard')->getAssetsUrl('js/chart.min.js'), 'chart.js');
        parent::__construct($id, $name);
    }

    public function setChartType($type)
    {
        $this->chartType = $type;
        return $this;
    }

    public function setOptions($options)
    {
        $this->chartOptions = $options;
        return $this;
    }

    public function getData()
    {
        return '<canvas id="dashboard-chart-' . $this->getId() . '"></canvas>
                    <script>
                    new Chart(document.getElementById("dashboard-chart-' . $this->getId() . '"), {
                        type: "' . $this->chartType . '",
                        data: ' . json_encode($this->getChartData()) . ',
                        options: ' . json_encode($this->chartOptions) . '
                    });
                    </script>
                ';
    }
}
