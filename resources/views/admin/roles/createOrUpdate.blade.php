<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end p-2">
                    <a href="{{ route('admin.roles.index') }}"
                        class="px-4 py-2 bg-green-500 hover:bg-green-300 rounded-md">Voltar</a>
                </div>
                <div>
                    <div>
                        <div class="container mx-auto">
                            <div class="bg-slate-500">
                                <h1 class="text-2xl font-semibold mb-4">
                                    {{ isset($role) ? 'Editar Role' : 'Criar Role' }}</h1>
                                <div class="max-w-xl">
                                    <form
                                        action="{{ isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store') }}"
                                        method="POST">
                                        @csrf
                                        @if (isset($role))
                                            @method('PUT')
                                        @endif

                                        <div class="mb-4">
                                            <label for="name" class="block font-medium mb-1">Nome:</label>
                                            <input type="text" id="name" name="name"
                                                class="w-full border border-gray-300 rounded px-4 py-2"
                                                value="{{ isset($role) ? $role->name : old('name') }}">
                                        </div>
                                        @error('name')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                        
                                        <div class="mt-4">
                                            <button type="submit"
                                                class="px-2 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{ isset($role) ? 'Atualizar' : 'Salvar' }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 p-2">
                            <h2 class="text-2xl font-semibold">Role Permissions</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($role->Permissions)
                                    @foreach ($role->Permissions as $role_permission)
                                    <form method="POST"
                                    action="{{route('admin.roles.permissions.revoke',[$role->id, $role_permission->id])}}" onsubmit="return confirm('Tem certeza?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">{{$role_permission->name}}</button>
                                    </form>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="max-w-xl mt-6">
                            <form
                                action="{{ route('admin.roles.permissions', $role)}}"
                                method="POST">
                                @csrf                               
                                <div class="mb-4">
                                    <label for="name" class="block font-medium mb-1">Nome:</label>
                                    <input type="text" id="name" name="name"
                                        class="w-full border border-gray-300 rounded px-4 py-2"
                                        value="{{ isset($role) ? $role->name : old('name') }}">
                                </div>
                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror

                                <div class="mb-4">
                                    <label for="permissions"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permission</label>
                                    <select id="permissions" name="permissions"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                           

                                <div class="mt-4">
                                    <button type="submit"
                                        class="px-2 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{'Atribuir'}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
