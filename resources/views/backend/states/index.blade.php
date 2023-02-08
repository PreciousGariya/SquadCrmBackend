@extends('backend.layouts.app')

@section('title') {{ __($module_action) }} {{ __($module_title) }} @endsection

@section('breadcrumbs')
<x-backend-breadcrumbs>
    <x-backend-breadcrumb-item type="active" icon='{{ $module_icon }}'>{{ __($module_title) }}</x-backend-breadcrumb-item>
</x-backend-breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ __($module_title) }} <small class="text-muted">{{ __($module_action) }}</small>

                </h4>
                <div class="small text-medium-emphasis">
                    <p>State Management</p>
                </div>
            </div>
           
            <div class="btn-toolbar d-block" role="toolbar" aria-label="Toolbar with buttons">
                <x-buttons.create route='{{ route("backend.states.backend.state.create") }}' title="{{__('Create')}}" />

            </div>
        </div>
        
      
        
        <div class="row mt-4">
            <div class="col">
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Country Code</th>
                            <th>Fips Code</th>
                            <th>Iso2</th>
                            <th>Type</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Flag</th>
                            <th>Wiki Data Id</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($module_name as $state)
                        <tr>
                            <td>{{ $state->name }}</td>
                            <td>{{ optional($state->country)->name }}</td>
                            <td>{{ $state->country_code }}</td>
                            <td>{{ $state->fips_code }}</td>
                            <td>{{ $state->iso2 }}</td>
                            <td>{{ $state->type }}</td>
                            <td>{{ $state->latitude }}</td>
                            <td>{{ $state->longitude }}</td>
                            <td>{{ $state->flag }}</td>
                            <td>{{ $state->wikiDataId }}</td>

                            <td>

                                <form method="POST" action="{!! route('backend.states.backend.state.destroy', $state->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('backend.states.backend.state.show', $state->id ) }}" class="btn btn-info" title="Show State">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('backend.states.backend.state.edit', $state->id ) }}" class="btn btn-primary" title="Edit State">
                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete State" onclick="return confirm(&quot;Click Ok to delete State.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $module_name->total() !!}
                </div>
            </div>
            <div class="col-5">
                <div class="float-end">
                    {!! $module_name->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection