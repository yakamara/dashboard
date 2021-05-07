<?php

/**
 * REDAXO Default-Theme.
 *
 * @author Design
 * @author ralph.zumkeller[at]yakamara[dot]de Ralph Zumkeller
 * @author <a href="https://www.yakamara.de">www.yakamara.de</a>
 * @author Umsetzung
 * @author thomas[dot]blum[at]redaxo[dot]org Thomas Blum
 *
 * @package redaxo5
 */

$plugin = rex_plugin::get('dashboard', 'demo');

if (rex::isBackend()) {
    foreach (['Demo 1', 'Demo 2'] as $name) {
        rex_dashboard::addItem(
            rex_dashboard_item_demo::factory('dashboard-' . $name, $name)
                ->setContent('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.')
        );
    }

    rex_dashboard::addItem(
        rex_dashboard_item_charts::factory('dashboard-demo-chart-1', 'Chartdemo 1')
            ->setChartType('bar')
            ->setChartData(<<<'CHARTDATA'
{
    labels: ['Rot', 'Blau', 'Gelb', 'Grün', 'Lila', 'Orange'],
    datasets: [{
        label: 'Chartdemo 1',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
    }]
}
CHARTDATA
            )
    );

    rex_dashboard::addItem(
        rex_dashboard_item_charts::factory('dashboard-demo-chart-2', 'Chartdemo 3')
            ->setChartType('polarArea')
            ->setChartData(<<<'CHARTDATA'
{
  labels: [
    'Rot',
    'Grün',
    'Gelb',
    'Grau',
    'Blau'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [11, 16, 7, 3, 14],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
}
CHARTDATA
            )
    );

    rex_dashboard::addItem(
        rex_dashboard_item_charts::factory('dashboard-demo-chart-3', 'Chartdemo 3')
            ->setChartType('pie')
            ->setChartData(<<<'CHARTDATA'
{
  labels: [
    'Red',
    'Blue',
    'Yellow'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [300, 50, 100],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
}
CHARTDATA
            )
    );
}
