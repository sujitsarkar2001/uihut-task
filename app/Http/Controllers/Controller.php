<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;
use Inertia\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * render view
     *
     * @param  string $component
     * @param  array $data
     */
    public function render($component, $data = []): Response
    {
        $component = request()->is('admin*') ? "Admin/$component" : "User/$component";
        return Inertia::render($component, $data);
    }
}
