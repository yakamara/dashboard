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
        );
    }

    rex_dashboard::addItem(
        rex_dashboard_item_chart_bar_horizontal::factory('dashboard-demo-chart-bar-horizontal', 'Chartdemo Balken horizontal')
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_bar_vertical::factory('dashboard-demo-chart-bar-vertical', 'Chartdemo Balken vertikal')
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_pie_demo::factory('dashboard-demo-chart-pie', 'Chartdemo Kreisdiagramm')
    );

    rex_dashboard::addItem(
        rex_dashboard_item_chart_pie_demo::factory('dashboard-demo-chart-donut', 'Chartdemo Donutdiagramm')
            ->setDonut()
    );

    rex_dashboard::addItem(
        rex_dashboard_item_table_demo::factory('dashboard-demo-table-sql', 'Tabelle (SQL)')
            ->setTableAttribute('data-locale', 'de-DE')
    );
}
