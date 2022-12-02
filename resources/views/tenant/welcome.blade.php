<x-site-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div>{{ config('app.name') }}</div>
        <div>{{ request()->tenant }}</div>
    </div>
</x-site-layout>
