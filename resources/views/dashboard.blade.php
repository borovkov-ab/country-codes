<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">
            You're logged in!
        </div>
        <hr class="hr" />
        <div clas="card-body">
            <div class="d-flex justify-content-around align-content-start">
                <div class="card my-4 mx-4 w-25 border align-self-start">
                    <div class="card-header">
                        <h5 class="card-title">
                            @if(!$editedCountryId)
                                Add New @else Edit
                            @endif Country
                        </h5>
                    </div>
                      @include('countries.addform')
                </div>
                <div class="card my-4 mx-4 w-75 border">
                    <div class="card-header">
                        <h5 class="card-title">Countries</h5>
                    </div>
                    <div class="card-body">
                       @include('countries.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
