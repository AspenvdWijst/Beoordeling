<div class="p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Bewerk opdracht</h2>
    <form action="{{ route('update.assignment', [$subject->id, $assignment->id]) }}" id="update_assignment">
        <label for="assignment_name" class="p-2">Naam opdracht</label>
        <br>
        <input type="text" placeholder="Naam opdracht" name="assignment_name" value="{{ $assignment->assignment_name }}" class="border m-2 p-2 rounded dark:text-black">
        <br>
        <label for="assignment_info" class="p-2">Opdracht info</label>
        <br>
        <textarea rows="3" cols="25" form="update_assignment" name="assignment_info" class="border mx-2 p-2 rounded dark:text-black">{{ $assignment->assignment_info }}
        </textarea>
        <br>
        <button type="submit" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
            Update
        </button>
    </form>
</div>
