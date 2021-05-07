<?php

/**
 * @package yakamara\dashboard
 */
abstract class rex_dashboard_item
{
    use rex_factory_trait;

    const ATTRIBUTES = [
        'width' => 'gs-w',
        'height' => 'gs-h',
        'x' => 'gs-x',
        'y' => 'gs-y',
    ];

    private static $ids = [];
    private static $itemData = null;
    private static $jsFiles = [];
    private static $cssFiles = [];

    private $name = null;
    private $id = null;
    private $content = '';
    private $options = [
        'show-header' => true,
    ];
    private $attributes = [
        'gs-w' => 1,
        'gs-h' => 3,
    ];

    protected function __construct($id, $name)
    {
        $this->id = rex_string::normalize($id);

        if (in_array($this->id, static::$ids)) {
            throw new Exception('ID "' . $id . '" (normalized: "' . $this->id . '") is already in use.');
        }

        static::$ids[] = $this->id;

        $this->name = $name;

        /** get stored positions and dimensions of item @see rex_api_dashboard_store */
        if ($user = rex::getUser()) {
            if (is_null(static::$itemData)) {
                static::$itemData = rex_config::get('dashboard', 'items_'.$user->getId(), []);
            }

            if (array_key_exists($this->id, static::$itemData)) {
                foreach (static::ATTRIBUTES as $attribute) {
                    if (array_key_exists($attribute, static::$itemData[$this->id])) {
                        $this->setAttribute($attribute, static::$itemData[$this->id][$attribute]);
                    }
                }
            }
        }
    }

    public static function factory($id, $name) : rex_dashboard_item
    {
        $class = self::getFactoryClass();
        return new $class($id, $name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    public function getOption($name)
    {
        return $this->options[$name] ?? null;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function getAttribute($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function getAttributes()
    {
        $this->attributes['data-id'] = $this->getId();
        return $this->attributes;
    }

    public function addJs($filename, $name = null)
    {
        if (file_exists($filename)) {
            if (is_null($name)) {
                $name = basename($filename);
            }

            if (!array_key_exists($name, static::$jsFiles)) {
                static::$jsFiles[$name] = $filename;
            }
        }

        return $this;
    }

    public static function getJsFiles()
    {
        return static::$jsFiles;
    }

    public function addCss($filename, $name = null)
    {
        if (file_exists($filename)) {
            if (is_null($name)) {
                $name = basename($filename);
            }

            if (!array_key_exists($name, static::$cssFiles)) {
                static::$cssFiles[$name] = $filename;
            }
        }

        return $this;
    }

    public static function getCssFiles()
    {
        return static::$cssFiles;
    }
}
