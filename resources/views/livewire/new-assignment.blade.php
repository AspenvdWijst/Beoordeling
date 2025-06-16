<div class="p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Nieuwe opdracht</h2>
    <form action="{{ route('submit.new.assignment', $subject->id) }}" id="new_assignment">
        <h2 for="assignment_name" class="m-2">Naam opdracht</h2>
        <input required type="text" placeholder="Naam opdracht" name="assignment_name" class="border m-2 p-2 rounded dark:text-black">
        <h2 for="assignment_info" class="m-2">Opdracht info</h2>
        <textarea required rows="6" cols="25" form="new_assignment" name="assignment_info" class="border mx-2 p-2 rounded dark:text-black"></textarea>
        <br>
        <button type="submit" class="btn btn-success px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
            Maak
        </button>
    </form>
</div>
