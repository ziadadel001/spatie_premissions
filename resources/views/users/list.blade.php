<x-app-layout>
    <x-slot name="header">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
        @can('create users')
        <a href="{{ route('user.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>

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
                Email
            </th>
            <th class="px-6 py-3 text-left">
                Roles
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
        @if ($users->isNotEmpty())
            @foreach ($users as $user )
            <tr class="border-b">
                <td class="px-6 py-3 text-left">{{ $user->id }}</td>
                <td class="px-6 py-3 text-left">{{ $user->name }}</td>
                <td class="px-6 py-3 text-left">{{ $user->email }}</td>
                <td class="px-6 py-3 text-left">{{ $user->roles->pluck('name')->implode(', ') }}</td>
                <td class="px-6 py-3 text-left">{{ $user->created_at->format('d M,Y') }}</td>
                <td class="px-6 py-3 text-center">
                    @can('edit users')
                    <a href="{{ route('user.edit',$user->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>

                    @endcan
                    @can('delete users')
                    <a href="javascript:void(0);" onclick="deleteuser({{ $user->id }})" class="bg-red-600 text-sm rounded-md text-white px-3 py-2 hover:bg-red-500">Delete</a>
   
                    @endcan

                </td>
            </tr>
            @endforeach
        @endif
       
    </tbody>
</table>
<div class="my-3">
    {{ $users->links() }}
</div>

            </div>
        </div>
    </div>
    <x-slot name="script">
    <script type="text/javascript">
function deleteuser(id){
if(confirm('Are You Sure you want to delete?')){
$.ajax({
    url : '{{ route('user.destroy') }}',
    type : 'delete' ,
    data : {id:id},
    headers : {
        'x-csrf-token': '{{ csrf_token() }}'
    },
    dataType : 'json',
    success : function(response){
window.location.href = '{{ route('user.index') }}';
    }

});
}
}
    </script>   
     </x-slot>

</x-app-layout>
