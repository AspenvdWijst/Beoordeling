<div class="bg-white shadow rounded p-4 dark:text-black">
    <b class="m-2">New Assignment</b>
    <form action="{{ route('submit.new.assignment', $subject->id) }}" id="new_assignment">
        <label for="assignment_name">Assignment name</label>
        <input type="text" placeholder="Assignment name" name="assignment_name" class="border m-2 p-2 rounded dark:text-black">
        <br>
        <label for="assignment_info" class="m-2">Assignment info</label>
        <textarea rows="3" cols="25" form="new_assignment" name="assignment_info" class="border mx-2 p-2 rounded dark:text-black"></textarea>
        <br>
        <button type="submit" class="btn btn-success text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</button>
    </form>
</div>
