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
        $chartData = [];
        $labels = [];
        $backgroundColors = [];
        $borderColors = [];

        $colors = $this->colors;

        foreach ($this->getChartData() as $label => $value) {

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

        return '<canvas id="dashboard-chart-' . $this->getId() . '"></canvas>
                    <script>
                    new Chart(document.getElementById("dashboard-chart-' . $this->getId() . '"), {
                        type: "' . $this->chartType . '",
                        data: ' . json_encode([
                            'labels' => $labels,
                            'datasets' => [$dataset],
                        ]) . ',
                        options: ' . json_encode($this->chartOptions) . '
                    });
                    </script>
                ';
    }
}
