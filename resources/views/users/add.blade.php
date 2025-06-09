<x-layouts.app>
    <h1 class="text-xl font-semibold mb-4 dark:text-black">Add a new user</h1>
    <form method="POST" action="save">
        @csrf
        Rol
        <br>
        <input type="radio" id="user" name="role_id" value="1" required>
        <label for="user">student</label><br>
        <input type="radio" id="teacher" name="role_id" value="2" required>
        <label for="teacher">docent</label><br>
        <input type="radio" id="admin" name="role_id" value="3" required>
        <label for="admin">admin</label>

        <br>
        <label for="user_name">Naam<br></label>
        <input type="text" id="user_name" name="user_name" required class="border mt-2 p-2 rounded">

        <br>
        <label for="user_email">Email<br></label>
        <input type="email" id="user_email" name="user_email" required class="border mt-2 p-2 rounded">

        <br>
        <input type="submit" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
    </form>
</x-layouts.app>

