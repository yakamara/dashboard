<?php

/**
 * @package yakamara\dashboard
 */
class rex_dashboard_item_chart extends rex_dashboard_item
{
    use rex_dashboard_chart_colors;

    protected $chartData = [];
    protected $chartType = '';
    protected $chartOptions = [];

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
     * @var array $data
    */
    public function setJsonData($data)
    {
        $this->chartData = $data;
        return $this;
    }

    public function setJsonOptions($options)
    {
        $this->chartOptions = $options;
        return $this;
    }

    public function setChartData(array $data)
    {
        $chartData = [];
        $labels = [];
        $backgroundColors = [];
        $borderColors = [];

        $colors = $this->colors;

        foreach ($data as $label => $value) {

            if (is_array($value)) {
                if (array_key_exists('label', $value) AND array_key_exists('value', $value)) {
                    $label = $value['label'];
                    $value = $value['value'];
                }
                else {
                    $label = array_shift($value);
                    $value = array_shift($value);
                }
            }

            $labels[] = $label;
            $chartData[] = $value;

            $color = array_shift($colors);

            if (is_array($color)) {
                $backgroundColors[] = $color[0];

                if (isset($color[1])) {
                    $borderColors[] = $color[1];
                }
            }
            else {
                $backgroundColors[] = $color;
            }
        }

        $dataset = [
            'label' => $this->name,
            'data' => $chartData,
            'backgroundColor' => $backgroundColors,
        ];

        if (!empty($borderColors)) {
            $dataset['borderColor'] = $borderColors;
            $dataset['borderWidth'] = 1;
        }

        $this->setJsonData([
            'labels' => $labels,
            'datasets' => [$dataset],
        ]);

        return $this;
    }

    public function setChartDataSql($query)
    {
        $this->setChartData(rex_sql::factory()->setQuery($query)->getArray());
        return $this;
    }

    public function getContent()
    {
        return '<canvas id="dashboard-chart-' . $this->getId() . '"></canvas>
                    <script>
                    new Chart(document.getElementById("dashboard-chart-' . $this->getId() . '"), {
                        type: "' . $this->chartType . '",
                        data: ' . json_encode($this->chartData) . ',
                        options: ' . json_encode($this->chartOptions) . '
                    });
                    </script>
                ';
    }
}
