<h2>Add a new user</h2>
<form method="POST" action="save">
    @csrf
    Role
    <br>
    <input type="radio" id="user" name="role_id" value="1" required>
    <label for="user">student</label><br>
    <input type="radio" id="teacher" name="role_id" value="2" required>
    <label for="teacher">teacher</label><br>
    <input type="radio" id="admin" name="role_id" value="3" required>
    <label for="admin">admin</label>

    <br>
    <label for="user_name">Name<br></label>
    <input type="text" id="user_name" name="user_name" required>

    <br>
    <label for="user_email">Email<br></label>
    <input type="email" id="user_email" name="user_email" required>

    <br>
    <input type="submit">
</form>
