<?php declare(strict_types=1);

namespace PhpGui\Layouts;

use PhpGui\Widgets\Widget;

/**
 * Layout manager interface.
 *
 * Layout manager arranges widgets in the container.
 */
interface LayoutManager
{
    /**
     * Pack the widget.
     */
    public function add(Widget $widget, array $options = []): self;

    /**
     * Remove the widget.
     */
    public function remove(Widget $widget): self;
}