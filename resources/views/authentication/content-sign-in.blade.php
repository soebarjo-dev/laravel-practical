<form method="POST" src="{{ route('sign-in.process') }}">
    @csrf
    <div class="mb-2">
        <label class="block text-gray-600 mb-1">E-Mail</label>
        @error('email')
            <span class="text-danger-500">{{ $message }}</span>
        @enderror
        <input type="email" name="email" class="w-full border p-2 focus:outline-none focus:ring focus:border-blue-300" required autofocus />
    </div>
    <div class="mb-3">
        <label class="block text-gray-600 mb-1">Password</label>
        @error('password')
            <span class="text-danger-500">{{ $message }}</span>
        @enderror
        <input type="password" name="password" class="w-full border p-2 focus:outline-none focus:ring focus:border-blue-300" required autofocus />
    </div>
    <button type="submit" class="w-full bg-blue-600 text-white py-2 hover:bg-blue-700">
        Login
    </button>
</form>
<a href="/register" class="text-sm text-blue-600 mt-5">Belum punya akun ? Daftar</a>