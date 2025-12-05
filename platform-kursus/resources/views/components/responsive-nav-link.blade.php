@props(['active'])

@php
// Periksa apakah rute saat ini sesuai dengan route(auth()->user()->role . '.*')
$isRoleHome = auth()->check() && request()->routeIs(auth()->user()->role . '.*');

// Tentukan kelas berdasarkan kondisi
$classes = ($active ?? false)
            ? ($isRoleHome
                ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-sky-400 text-start text-base font-semibold font-mono text-sky-800 bg-sky-50 focus:outline-none focus:text-sky-800 focus:bg-sky-100 focus:border-sky-700 transition duration-150 ease-in-out'
                : 'block w-full ps-3 pe-4 py-2 border-l-4 border-sky-400 text-start text-base font-semibold font-mono text-sky-700 bg-sky-50 focus:outline-none focus:text-sky-800 focus:bg-sky-100 focus:border-sky-700 transition duration-150 ease-in-out')
            : ($isRoleHome
                ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold font-mono text-white hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out'
                : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-semibold font-mono text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
