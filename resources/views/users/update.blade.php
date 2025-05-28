<h2>Update {{$user->name}}</h2>
<form method="POST" action="save">
    @csrf
    Role
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

    <label for="teacher">teacher</label><br>
    <input type="radio" id="admin" name="role_id" value="3" required
        @if($user->role_id==3)
            checked="checked"
        @endif>
    <label for="admin">admin</label>

    <br>
    <label for="user_name">Name<br></label>
    <input type="text" id="user_name" name="user_name" required value="{{$user->name}}">

    <br>
    <label for="user_email">Email<br></label>
    <input type="email" id="user_email" name="user_email" required value="{{$user->email}}">

    <br>
    <input type="submit" value="Update">
</form>

<h2>Delete:</h2>
<form action="delete">
    <input type="text" id="confirmInput" placeholder='Typ VERWIJDEREN om knop te activeren' autocomplete="off"><br>
    <input type="submit" id="submitBtn" value="Verwijderen" disabled>
</form>

<script>
    const input = document.getElementById('confirmInput');
    const submitBtn = document.getElementById('submitBtn');

    input.addEventListener('input', function () {
        submitBtn.disabled = input.value !== 'VERWIJDEREN';
    });
</script>
