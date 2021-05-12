<?php
class rex_dashboard_item_chart_bar_horizontal extends rex_dashboard_item_chart_bar
{
    public function getChartData()
    {
        $chartData = [];
        $labels = [];
        $backgroundColors = [];
        $borderColors = [];

        $colors = $this->colors;

        foreach ([
            'Rot' => 12,
            'Blau' => 19,
            'Gelb' => 3,
            'Grün' => 5,
            'Lila' => 2,
            'Orange' => 3,
        ] as $label => $value) {

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
            'orientation' => 'horizontal',
        ];

        if (!empty($borderColors)) {
            $dataset['borderColor'] = $borderColors;
            $dataset['borderWidth'] = 1;
        }

        return [
            'labels' => $labels,
            'datasets' => [$dataset],
        ];
    }
}
