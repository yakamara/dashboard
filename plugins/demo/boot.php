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
        rex_dashboard_item_chart_bar::factory('dashboard-demo-chart-bar-horizontal', 'Chartdemo Balken horizontal')
            ->setHorizontal()
            ->setChartData([
                'Rot' => 12,
                'Blau' => 19,
                'Gelb' => 3,
                'Grün' => 5,
                'Lila' => 2,
                'Orange' => 3,
            ])
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_bar::factory('dashboard-demo-chart-bar-vertical', 'Chartdemo Balken vertikal')
            ->setChartData([
                'Rot' => 12,
                'Blau' => 19,
                'Gelb' => 3,
                'Grün' => 5,
                'Lila' => 2,
                'Orange' => 3,
            ])
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_pie::factory('dashboard-demo-chart-pie', 'Chartdemo Kreisdiagramm')
            ->setChartData([
                'Rot' => 12,
                'Blau' => 19,
                'Gelb' => 3,
                'Grün' => 5,
                'Lila' => 2,
                'Orange' => 3,
            ])
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_pie::factory('dashboard-demo-chart-donut', 'Chartdemo Donutdiagramm')
            ->setDonut()
            ->setChartData([
                'Rot' => 12,
                'Blau' => 19,
                'Gelb' => 3,
                'Grün' => 5,
                'Lila' => 2,
                'Orange' => 3,
            ])
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_pie::factory('dashboard-demo-chart-sql', 'Artikelanzahl pro Nutzer')
            ->setChartDataSql('
                SELECT u.name label, COUNT(*) value
                FROM rex_user u
                INNER JOIN rex_article a
                    ON a.createuser = u.login
                GROUP BY u.id
                ORDER BY COUNT(*) DESC
            ')
    );
}
