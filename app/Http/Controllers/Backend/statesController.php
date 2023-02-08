<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\backend\state;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;



class statesController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'State';

        // module name
        $this->module_name = 'state';

        // directory path of the module
        $this->module_path = 'state';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\backend\state";
    }

    /**
     * Display a listing of the states.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';
        $module_name = state::with('country')->paginate(25);

        return view('backend.states.index', compact('module_title', 'module_name', "module_name", 'module_icon', 'module_name_singular', 'module_action'));
    }

    /**
     * Show the form for creating a new state.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::pluck('name','id')->all();
        
        return view('backend.states.create', compact('countries'));
    }

    /**
     * Store a new state in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            state::create($data);

            return redirect()->route('backend.states.backend.state.index')
                ->with('success_message', 'state was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified state.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $module_action = 'show';
        $$module_name = $module_model::with('country')->findOrFail($id);

        return view('backend.states.show', compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action'));
    }

    /**
     * Show the form for editing the specified state.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'edit';
        $$module_name = $module_model::findOrFail($id);
        $countries = Country::pluck('name','id')->all();

        return view('backend.states.edit', compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action','countries'));
    }

    /**
     * Update the specified state in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $state = state::findOrFail($id);
            $state->update($data);

            return redirect()->route('backend.states.backend.state.index')
                ->with('success_message', 'state was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified state from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $state = state::findOrFail($id);
            $state->delete();

            return redirect()->route('backend.states.backend.state.index')
                ->with('success_message', 'state was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'name' => 'string|min:1|max:255|nullable',
            'country_id' => 'numeric|min:0|max:4294967295|nullable',
            'country_code' => 'numeric|nullable',
            'fips_code' => 'string|min:1|nullable',
            'iso2' => 'string|min:1|nullable',
            'type' => 'string|min:1|nullable',
            'latitude' => 'string|min:1|nullable',
            'longitude' => 'string|min:1|nullable',
            'flag' => ['string','min:1','nullable','file'],
            'wikiDataId' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);
        if ($request->has('custom_delete_flag')) {
            $data['flag'] = null;
        }
        if ($request->hasFile('flag')) {
            $data['flag'] = $this->moveFile($request->file('flag'));
        }

        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

}
