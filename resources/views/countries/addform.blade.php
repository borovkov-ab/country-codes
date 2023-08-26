<div class="card-body">
    <form id="addform" action="{{ route('country.store') }}" method="POST">
        @csrf
        <div class="card-body">
            @isset($editedCountryId)
                <input type="hidden" name="id" value="{{ $editedCountryId }}" />
            @endisset

            <x-label for="name" :value="__('Name')" />
            <x-input id="name" type="text" name="name" :value=" $editedCountryId ? $countries[$editedCountryId]['name'] : old('name') " required autofocus />
            <x-label for="code" :value="__('Code')" />
            <x-input id="code" type="text" name="code" :value="$editedCountryId ? $countries[$editedCountryId]['code'] : old('code')" required autofocus />
        </div>
    </form>
</div>
<div class="card-footer border bg-light d-flex">
    <button type="submit" form="addform" class="btn btn-primary ms-auto">Save</button>
</div>

