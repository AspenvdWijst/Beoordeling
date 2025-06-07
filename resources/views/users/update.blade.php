<x-layouts.app>
    <h1 class="text-xl font-semibold mb-4 dark:text-black">Update {{$user->name}}</h1>
    <form method="POST" action="save">
        @csrf
        <div class="font-bold">Rol</div>
        <br>
        <input type="radio" id="user" name="role_id" value="1" required
            @if($user->role_id==1)
                checked="checked"
            @endif>

        <label for="user">student</label><br>
        <input type="radio" id="teacher" name="role_id" value="2" required
            @if($user->role_id==2)
                checked="checked"
            @endif>

        <label for="teacher">docent</label><br>
        <input type="radio" id="admin" name="role_id" value="3" required
            @if($user->role_id==3)
                checked="checked"
            @endif>
        <label for="admin">admin</label>

        <br>
        <label for="user_name" class="font-bold">Naam<br></label>
        <input type="text" id="user_name" name="user_name" required class="border mt-2 p-2 rounded" value="{{$user->name}}">

        <br>
        <label for="user_email" class="font-bold">Email<br></label>
        <input type="email" id="user_email" name="user_email" required class="border mt-2 p-2 rounded" value="{{$user->email}}">

        <br>
        <input type="submit" value="Update" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
    </form>

    <h2 class="font-bold mt-3">Verwijder:</h2>
    <form action="delete">
        <input type="text" id="confirmInput" placeholder='Typ VERWIJDEREN om knop te activeren' class="w-80 border mt-2 p-2 rounded" autocomplete="off"><br>
        <input type="submit" id="submitBtn" value="Verwijderen" disabled class="disabled:bg-neutral-500 px-6 py-3 mt-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </form>

    <script>
        const input = document.getElementById('confirmInput');
        const submitBtn = document.getElementById('submitBtn');

        input.addEventListener('input', function () {
            submitBtn.disabled = input.value !== 'VERWIJDEREN';
        });
    </script>
</x-layouts.app>
