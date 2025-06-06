<div class="p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Nieuwe opdracht</h2>
    <form action="{{ route('submit.new.assignment', $subject->id) }}" id="new_assignment">
        <h2 for="assignment_name" class="m-2">Naam opdracht</h2>
        <input type="text" placeholder="Naam opdracht" name="assignment_name" class="border m-2 p-2 rounded dark:text-black">
        <h2 for="assignment_info" class="m-2">Opdracht info</h2>
        <textarea rows="6" cols="25" form="new_assignment" name="assignment_info" class="border mx-2 p-2 rounded dark:text-black"></textarea>
        <br>
        <button type="submit" class="btn btn-success text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 m-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Maak
        </button>
    </form>
</div>
