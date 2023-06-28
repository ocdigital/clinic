<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-3/4">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-200 text-gray-800 px-6 py-4">{{ 'Editar Usuário' }}</div>

                    <div class="p-6">
                        <form method="POST" action="{{ url("/users/{$user->id}") }}">
                            @csrf
                            @method('PUT')
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" required>
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required>
                            <label for="role">Role</label>
                            <select name="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->roles->contains('id', $role->id)) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
