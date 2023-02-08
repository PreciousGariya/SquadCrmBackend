<?php

namespace Modules\File\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class FilesController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Files';

        // module name
        $this->module_name = 'files';

        // directory path of the module
        $this->module_path = 'file::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\File\Models\File";
    }

}
