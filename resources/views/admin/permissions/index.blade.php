<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end p-2">
                    <a href="{{ route('admin.permissions.create')}}" class="px-4 py-2 bg-green-500 hover:bg-green-300 rounded-md">Create</a>          
                </div>
                <div class="container mx-auto">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                      <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Nome
                            </th>                           
                            <th scope="col" class="relative px-6 py-3">
                              <span class="sr-only">Edit</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($permissions as $permission)                            
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                        {{ $permission->name }}                                        
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Deletar</a>
                                    </td>
                                </tr>
                            @endforeach
                          <!-- More table rows... -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
            </div>
        </div>
    </div>
</x-admin-layout>
