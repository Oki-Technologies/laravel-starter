<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business') }}
        </h2>

        <nav class="nav">
            <a class="link-item" href="{{ route('office.business.create') }}">Create</a>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Hostname</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($businesses ?? [] as $business)
                        <tr>
                            <td>
                                <a href="http://{{ $business->domain }}">
                                    {{ $business->name }}
                                </a>
                            </td>
                            <td>{{ $business->domain }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">...empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
