<?php

namespace Modules\Contact\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;

class ContactsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Contacts';

        // module name
        $this->module_name = 'contacts';

        // directory path of the module
        $this->module_path = 'contact::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Contact\Models\Contact";
    }

}
