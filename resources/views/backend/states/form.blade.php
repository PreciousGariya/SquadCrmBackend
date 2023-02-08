<div class="row mb-3">

    <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-2 control-label">Name</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="name" type="text" id="name"
                value="{{ old('name', optional($state)->name) }}" minlength="1" maxlength="255"
                placeholder="Enter name here...">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('country_id') ? 'has-error' : '' }}">
        <label for="country_id" class="col-md-2 control-label">Country</label>
        <div class="col-md-10">
            <select class="form-control form-control" id="country_id" name="country_id">
                <option value="" style="display: none;"
                    {{ old('country_id', optional($state)->country_id ?: '') == '' ? 'selected' : '' }} disabled
                    selected>Enter country here...</option>
                @foreach ($countries as $key => $country)
                    <option value="{{ $key }}"
                        {{ old('country_id', optional($state)->country_id) == $key ? 'selected' : '' }}>
                        {{ $country }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('country_code') ? 'has-error' : '' }}">
        <label for="country_code" class="col-md-2 control-label">Country Code</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="country_code" type="number" id="country_code"
                value="{{ old('country_code', optional($state)->country_code) }}"
                placeholder="Enter country code here...">
            {!! $errors->first('country_code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('fips_code') ? 'has-error' : '' }}">
        <label for="fips_code" class="col-md-2 control-label">Fips Code</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="fips_code" type="text" id="fips_code"
                value="{{ old('fips_code', optional($state)->fips_code) }}" minlength="1"
                placeholder="Enter fips code here...">
            {!! $errors->first('fips_code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('iso2') ? 'has-error' : '' }}">
        <label for="iso2" class="col-md-2 control-label">Iso2</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="iso2" type="text" id="iso2"
                value="{{ old('iso2', optional($state)->iso2) }}" minlength="1" placeholder="Enter iso2 here...">
            {!! $errors->first('iso2', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
        <label for="type" class="col-md-2 control-label">Type</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="type" type="text" id="type"
                value="{{ old('type', optional($state)->type) }}" minlength="1" placeholder="Enter type here...">
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('latitude') ? 'has-error' : '' }}">
        <label for="latitude" class="col-md-2 control-label">Latitude</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="latitude" type="text" id="latitude"
                value="{{ old('latitude', optional($state)->latitude) }}" minlength="1"
                placeholder="Enter latitude here...">
            {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('longitude') ? 'has-error' : '' }}">
        <label for="longitude" class="col-md-2 control-label">Longitude</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="longitude" type="text" id="longitude"
                value="{{ old('longitude', optional($state)->longitude) }}" minlength="1"
                placeholder="Enter longitude here...">
            {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('flag') ? 'has-error' : '' }}">
        <label for="flag" class="col-md-2 control-label">Flag</label>
        <div class="col-md-10">
            <div class="input-group uploaded-file-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Browse <input type="file" name="flag" id="flag" class="hidden form-control">
                    </span>
                </label>
                <input type="text" class="form-control uploaded-file-name" readonly>
            </div>

            @if (isset($state->flag) && !empty($state->flag))
                <div class="input-group input-width-input">
                    <span class="input-group-addon">
                        <input type="checkbox" name="custom_delete_flag" class="custom-delete-file" value="1"
                            {{ old('custom_delete_flag', '0') == '1' ? 'checked' : '' }}> Delete
                    </span>

                    <span class="input-group-addon custom-delete-file-name">
                        {{ $state->flag }}
                    </span>
                </div>
            @endif
            {!! $errors->first('flag', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group  {{ $errors->has('wikiDataId') ? 'has-error' : '' }}">
        <label for="wikiDataId" class="col-md-2 control-label">Wiki Data Id</label>
        <div class="col-md-10">
            <input class="form-control form-control" name="wikiDataId" type="text" id="wikiDataId"
                value="{{ old('wikiDataId', optional($state)->wikiDataId) }}" minlength="1"
                placeholder="Enter wiki data id here...">
            {!! $errors->first('wikiDataId', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>
