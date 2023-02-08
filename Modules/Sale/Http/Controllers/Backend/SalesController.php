<?php

namespace Modules\Sale\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class SalesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Sales';

        // module name
        $this->module_name = 'sales';

        // directory path of the module
        $this->module_path = 'sale::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Sale\Models\Sale";
    }

}
