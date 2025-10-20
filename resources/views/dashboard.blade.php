<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Bienvenido, {{ Auth::user()->name }}</h3>
                    <p class="mb-6 text-gray-600">Has iniciado sesión correctamente.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="{{ route('clientes.index') }}" class="p-5 bg-blue-100 hover:bg-blue-200 rounded-lg text-center shadow">
                            <h4 class="font-semibold text-blue-800 mb-2">👥 Clientes</h4>
                            <p class="text-sm text-blue-600">Gestionar registros de clientes</p>
                        </a>

                        <a href="#" class="p-5 bg-green-100 hover:bg-green-200 rounded-lg text-center shadow">
                            <h4 class="font-semibold text-green-800 mb-2">🍔 Productos</h4>
                            <p class="text-sm text-green-600">Próximamente</p>
                        </a>

                        <a href="#" class="p-5 bg-yellow-100 hover:bg-yellow-200 rounded-lg text-center shadow">
                            <h4 class="font-semibold text-yellow-800 mb-2">📦 Pedidos</h4>
                            <p class="text-sm text-yellow-600">Próximamente</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

