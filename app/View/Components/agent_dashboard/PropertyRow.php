<?php

namespace App\View\Components\agent_dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PropertyRow extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public $firstImage;

    public function __construct($data)
    {
        $this->data = $data;

        // $images = json_decode(optional($data->media)->file_path, true);

        $this->firstImage = $data->getFirstImage() ?? 'default.jpg';
    }

    public function render()
    {
        return view('components.agent_dashboard.property-row');
    }
}
