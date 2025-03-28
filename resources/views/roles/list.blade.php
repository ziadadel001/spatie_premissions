<x-app-layout>
    <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
        @can('create roles')
        <a href="{{ route('role.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
 
        @endcan
      </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<x-message></x-message>
          
<table class="w-full">
    <thead class="bg-gray-50">
        <tr class="border-b">
            <th class="px-6 py-3 text-left" width="60">
                #
            </th>
            <th class="px-6 py-3 text-left">
                Name
            </th>
            <th class="px-6 py-3 text-left">
                permissions
            </th>
            <th class="px-6 py-3 text-left" width="180">
                Created
            </th>
            <th class="px-6 py-3 text-center" width="180">
                Action
            </th>
        </tr>
    </thead>
    <tbody class="bg-whte">
        @if ($roles->isNotEmpty())
            @foreach ($roles as $role )
            <tr class="border-b">
                <td class="px-6 py-3 text-left">{{ $role->id }}</td>
                <td class="px-6 py-3 text-left">{{ $role->name }}</td>
                <td class="px-6 py-3 text-left">{{ $role->permissions->pluck('name')->implode(',') }}</td>
                <td class="px-6 py-3 text-left">{{ $role->created_at->format('d M,Y') }}</td>
                <td class="px-6 py-3 text-center">
                    @can('edit roles')
                        
                    <a href="{{ route('role.edit',$role->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                    @endcan

                    @can('delete roles')

                    <a href="javascript:void(0);" onclick="deleteRole({{ $role->id }})" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">Delete</a>
                    @endcan

                </td>
            </tr>
            @endforeach
        @endif
       
    </tbody>
</table>
<div class="my-3">
    {{ $roles->links() }}
</div>

            </div>
        </div>
    </div>
    <x-slot name="script">
    <script type="text/javascript">
function deleteRole(id){
if(confirm('Are You Sure you want to delete?')){
$.ajax({
    url : '{{ route('role.destroy') }}',
    type : 'delete' ,
    data : {id:id},
    headers : {
        'x-csrf-token': '{{ csrf_token() }}'
    },
    dataType : 'json',
    success : function(response){
window.location.href = '{{ route('role.index') }}';
    }

});
}
}
    </script>   
     </x-slot>

</x-app-layout>
