<x-admin-layout>
  <div class="py-12 w-full">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

              <div class="flex justify-end p-2">
                
                  <a href="{{ route('admin.roles.create')}}" class="px-4 py-2 bg-green-500 hover:bg-green-300 rounded-md">Create</a>              
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
                          @foreach ($roles as $role)                            
                              <tr>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <div class="flex items-center">
                                      {{ $role->name }}                                        
                                      </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex justify-end items-center">
                                        <a href="{{ route('admin.roles.edit', $role->id)}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Editar</a>
                                        <button type="button" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" onclick="openDeleteModal('{{ $role->id }}')">Deletar</button>
                                    </div>
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

  <!-- Modal -->
  <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
      <div class="bg-white w-1/3 p-6 rounded shadow-lg">
          <h2 class="text-xl font-bold mb-4">Confirmar exclusão</h2>
          <p class="mb-4">Tem certeza que deseja deletar?</p>
          <div class="flex justify-end">
              <button class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2" onclick="closeDeleteModal()">Cancelar</button>
              <form id="deleteForm" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">Deletar</button>
              </form>
          </div>
      </div>
  </div>

  <script>
      function openDeleteModal(roleId) {
          const deleteModal = document.getElementById('deleteModal');
          const deleteForm = document.getElementById('deleteForm');
          deleteForm.action = "{{ route('admin.roles.destroy', '') }}" + "/" + roleId;
          deleteModal.classList.remove('hidden');
      }

      function closeDeleteModal() {
          const deleteModal = document.getElementById('deleteModal');
          deleteModal.classList.add('hidden');
      }
  </script>
</x-admin-layout>
