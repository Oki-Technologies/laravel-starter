<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Business') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('office.business.store') }}" method="POST">
                {{-- Name --}}
                <div class="input-group">
                    <label for="name" class="input-group-text">Name</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</x-app-layout>
