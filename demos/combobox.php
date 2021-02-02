<?php

use TclTk\App;
use TclTk\Widgets\Buttons\Button;
use TclTk\Widgets\Combobox;
use TclTk\Widgets\Entry;
use TclTk\Widgets\Frame;
use TclTk\Widgets\Label;
use TclTk\Widgets\LabelFrame;
use TclTk\Widgets\Scrollbar;
use TclTk\Widgets\Window;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$demo = new class extends Window
{
    private array $themes;

    public function __construct()
    {
        parent::__construct(App::create(), 'Combobox Demo');
        $this->themes = $this->app()->style()->themes();
        $this->themeSelector()->pack()->pad(6, 6)->fillX()->manage();
        $this->plainSelector()->pack()->pad(6, 6)->fillX()->manage();
        $this->themeDemo()->pack()->pad(6, 6)->fillX()->manage();
    }

    protected function themeSelector(): Frame
    {
        $f = new LabelFrame($this, 'Theme:');
        $l = new Label($f, 'Combobox is disabled.');
        $l->pack()->manage();
        $themes = new Combobox($f, $this->themes, ['state' => 'readonly']);
        $themes->pack()->fillX()->pad(4, 4)->manage();
        $themes->onSelect([$this, 'changeTheme']);

        $cur = $this->app()->style()->currentTheme();
        if (($idx = array_search($cur, $this->themes)) !== false) {
            $themes->setSelection($idx);
        }

        return $f;
    }

    protected function plainSelector(): Frame
    {
        $f = new LabelFrame($this, 'Combobox:');
        $l = new Label($f, 'Selected...');
        $l->pack()->manage();
        $cb = new Combobox($f, ['Item 1', 'Item 2', 'Item 3']);
        $cb->onSelect(fn () => $l->text = $cb->getValue());
        $cb->pack()->fillX()->pad(4, 4)->manage();
        return $f;
    }

    protected function themeDemo(): Frame
    {
        $f = new LabelFrame($this, 'Theme demo:');
        (new Button($f, 'Button'))->pack()->sideTop()->padY(4)->manage();
        (new Entry($f, 'value...'))->pack()->sideTop()->padY(4)->manage();
        (new Scrollbar($f, false))->pack()->sideTop()->pad(4, 4)->fillX()->expand()->manage();
        return $f;
    }

    public function changeTheme(int $index)
    {
        $theme = $this->themes[$index];
        $this->app()->style()->useTheme($theme);
    }
};

$demo->app()->mainLoop();