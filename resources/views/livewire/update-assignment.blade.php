<div class="bg-white shadow rounded p-4 dark:text-black">
    <b class="m-2">Edit Assignment</b>
    <form action="{{ route('update.assignment', [$subject->id, $assignment->id]) }}" id="update_assignment">
        <label for="assignment_name" class="p-2">Assignment name</label>
        <br>
        <input type="text" placeholder="Assignment name" name="assignment_name" value="{{ $assignment->assignment_name }}" class="border m-2 p-2 rounded dark:text-black">
        <br>
        <label for="assignment_info" class="p-2">Assignment info</label>
        <br>
        <textarea rows="3" cols="25" form="update_assignment" name="assignment_info" class="border mx-2 p-2 rounded dark:text-black">{{ $assignment->assignment_info }}
        </textarea>
        <br>
        <button type="submit" class="btn btn-success text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Update
        </button>
    </form>
</div>
