<?php

/**
 * @package yakamara\dashboard
 */
class rex_dashboard_item_charts extends rex_dashboard_item
{
    private $chartData = '{}';
    private $chartType = 'bar';
    private $chartOptions = '{}';

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

    /**
     * If $data is a string, it has to be valid JSON.
     * @var string|array|object $data
    */
    public function setChartData($data)
    {
        if (!is_string($data)) {
            $data = json_encode($data);
        }

        $this->chartData = $data;
        return $this;
    }

    public function setChartOptions($options)
    {
        if (!is_string($options)) {
            $data = json_encode($options);
        }

        $this->chartOptions = $options;
        return $this;
    }

    public function getContent()
    {
        return '<canvas id="dashboard-chart-' . $this->getId() . '"></canvas>
                    <script>
                    new Chart(document.getElementById("dashboard-chart-' . $this->getId() . '"), {
                        type: "' . $this->chartType . '",
                        data: ' . $this->chartData . ',
                        options: ' . $this->chartOptions . '
                    });
                    </script>
                ';
    }
}
