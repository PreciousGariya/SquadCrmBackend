

@extends ('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item route='{{route("backend.states.backend.state.index")}}' icon='{{ $module_icon }}'>
        {{ __($module_title) }}
    </x-backend-breadcrumb-item>
    <x-backend-breadcrumb-item type="active">{{ __($module_action) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <x-backend.section-header>
            <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

            <x-slot name="subtitle">
                @lang(":module_name Management Dashboard", ['module_name'=>Str::title($module_name)])
            </x-slot>
            <x-slot name="toolbar">
                <x-buttons.return-back />
                <x-buttons.edit route='{!!route("backend.states.backend.state.edit", $$module_name_singular)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" class="ms-1" />
            </x-slot>
        </x-backend.section-header>
        
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $$module_name->name }}</dd>
                        <dt>Country</dt>
                        <dd>{{ optional($$module_name->country)->name }}</dd>
                        <dt>Country Code</dt>
                        <dd>{{ $$module_name->country_code }}</dd>
                        <dt>Fips Code</dt>
                        <dd>{{ $$module_name->fips_code }}</dd>
                        <dt>Iso2</dt>
                        <dd>{{ $$module_name->iso2 }}</dd>
                        <dt>Type</dt>
                        <dd>{{ $$module_name->type }}</dd>
                        <dt>Latitude</dt>
                        <dd>{{ $$module_name->latitude }}</dd>
                        <dt>Longitude</dt>
                        <dd>{{ $$module_name->longitude }}</dd>
                        <dt>Flag</dt>
                        <dd><img src="{{ asset('storage/' . $$module_name->flag) }}" alt=""></dd>
                        <dt>Wiki Data Id</dt>
                        <dd>{{ $$module_name->wikiDataId }}</dd>
            
                    </dl>
                </div>
                <!--table-responsive-->
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-end text-muted">
                    Updated: {{$$module_name_singular->updated_at->diffForHumans()}},
                    Created at: {{$$module_name_singular->created_at->isoFormat('LLLL')}}
                </small>
            </div>
        </div>
    </div>
</div>
@endsection