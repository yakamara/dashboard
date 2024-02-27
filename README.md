# Dashboard für REDAXO 5.x

Das AddOn `dashboard` ermöglicht es, Daten aus Projekten und AddOns die das Dashboard unterstützen, anzuzeigen
Ein Dashboard besteht aus mehreren Widgets, die in einer beliebigen Anordnung auf der Startseite des REDAXO-Backends angezeigt werden. Die Widgets können aus verschiedenen Quellen stammen, z.B. aus anderen AddOns, aus eigenen PHP-Dateien oder aus externen Quellen.

Zunächst braucht man eine Klasse, die das Widget repräsentiert. Diese Klasse muss von einem der folgenden Dashboard Klassen erben, um eine bestimmte Darstellung zu erzwingen.

* rex_dashboard_item
* rex_dashboard_item_chart_bar
* rex_dashboard_item_chart_line
* rex_dashboard_item_chart_pie
* rex_dashboard_item_chart
* rex_dashboard_item_table

Als Beispiele sind hier die Klassen aus dem DemoPlugin aufgeführt:

### rex_dashboard_item

```php
class rex_dashboard_item_demo extends rex_dashboard_item
{
    public function getData()
    {
        return 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.';
    }
}
```

### rex_dashboard_item_chart_bar

```php

class rex_dashboard_item_my_chart_bar_horizontal extends rex_dashboard_item_chart_bar
{
    protected function __construct($id, $name)
    {
        parent::__construct($id, $name);
        $this->setHorizontal(); // optional, sonst vertikal
    }

    public function getChartData()
    {
        return [
            'Rot' => rand(1,122),
            'Blau' => rand(1,122),
            'Gelb' => rand(1,122),
            'Grün' => rand(1,122),
            'Lila' => rand(1,122),
            'Orange' => rand(1,122),
        ];
    }
}

```

### rex_dashboard_item_chart_line

```php

class rex_dashboard_item_chart_line_demo extends rex_dashboard_item_chart_line
{
    public function getChartData()
    {
        return [
            'Linie 1' => [
                'Rot' => 12,
                'Blau' => 19,
                'Gelb' => 3,
                'Grün' => 5,
                'Lila' => 2,
                'Orange' => 3,
            ],
            'Linie 2' => [
                'Rot' => 3,
                'Blau' => 5,
                'Gelb' => 8,
                'Grün' => 10,
                'Lila' => 11,
                'Orange' => 11.5,
            ],
            'Linie 3' => [
                'Rot' => 5,
                'Blau' => 13,
                'Gelb' => 16,
                'Grün' => 12,
                'Lila' => 7,
                'Orange' => 2,
            ]
        ];
    }
}

```

### rex_dashboard_item_chart_pie

```php

class rex_dashboard_item_chart_pie_demo extends rex_dashboard_item_chart_pie
{
    public function getChartData()
    {
        return [
            'Rot' => 12,
            'Blau' => 19,
            'Gelb' => 3,
            'Grün' => 5,
            'Lila' => 2,
            'Orange' => 3,
        ];
    }
}

```
### rex_dashboard_item_table

```php

class rex_dashboard_item_table_demo extends rex_dashboard_item_table
{
    protected $header = [];
    protected $data = [];

    protected function getTableData()
    {
        $tableData = rex_sql::factory()->setQuery('
            SELECT  id ID
                    , label Label
                    , dbtype `DB-Type`
            FROM rex_metainfo_type
            ORDER BY id ASC
        ')->getArray();

        if (!empty($tableData)) {
            $this->data = $tableData;
            $this->header = array_keys($tableData[0]);
        }

        return [
            'data' => $this->data,
            'header' => $this->header,
        ];
    }
}

```

## Anmeldung der eigenen Widgets

In der boot.php des eigenen Project-AddOns oder in der jeweiligen boot.php des entsprechenden AddOns (Für AddOn-Entwickler) müssen die entsprechenden Widgets angemeldet werden.

Hier ein Beispiel für die Anmeldung der Widgets aus dem DemoPlugin, siehe oben:

```php

if (rex::isBackend() && rex_addon::exists('dashboard')) {

    rex_dashboard::addItem(
        rex_dashboard_item_demo::factory('dashboard-demo-1', 'Demo 1')
    );

    rex_dashboard::addItem(
        rex_dashboard_item_demo::factory('dashboard-demo-2', 'Demo 2')
            ->setColumns(2)
    );

    rex_dashboard::addItem(
        rex_dashboard_item_demo::factory('dashboard-demo-3', 'Demo 3')
            ->setColumns(3)
    );

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

    rex_dashboard::addItem(
        rex_dashboard_item_chart_line_demo::factory('dashboard-demo-chart-line', 'Liniendiagramm')
    );

);

```

## Auswählen des Widgets im Dashboard

Sobald die Widgets angemeldet sind, können sie im Dashboard ausgewählt und angeordnet werden. Dazu klickt man im Widget auf `Widget auswählen`.
