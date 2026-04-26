<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Master Pengguna</h2>
        <a href="{{ route('master-users.create') }}" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
            + Tambah
        </a>
    </div>

    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-gray-200 border">
                <th class="text-center p-2">No.</th>
                <th class="text-center p-2">Nama</th>
                <th class="text-center p-2">E-Mail</th>
                <th class="text-center p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($data['users']))
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-400">Belum ada data pengguna</td>
                </tr>
            @else
                @foreach($data['users'] as $i => $user)
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center">{{ $i+1 }}</td>
                    <td class="py-2 border-x p-2">{{ $user['name'] }}</td>
                    <td class="py-2 border-x p-2">{{ $user['email'] }}</td>
                    <td class="py-2 border-x p-2 text-center">
                        <a href="{{ route('master-users.edit', ['user' => $user['id']]) }}">Edit</a> |
                        <a onclick="
                            event.preventDefault();
                            if(confirm('Apakah anda yakin ingin menghapus data : {{ $user['name'] }}?')){
                                document.getElementById('form-submit-delete-{{ $user['id'] }}').submit()
                            }
                        ">
                            Hapus
                        </a>

                        <form id="form-submit-delete-{{ $user['id'] }}" class="hidden" method="post" action="{{ route('master-users.destroy', ['user' => $user['id']]) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <p class="text-xs mt-3">Total Data : {{ $data['users']->count() }}</p>
</div>
