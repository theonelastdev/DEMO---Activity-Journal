<x-layout title="Add Activity">
    <div class="mb-6">
        <a href="{{ route('activities.index') }}" class="text-blue-600 hover:underline">&larr; Back to Activities</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Activity</h1>

        <form action="{{ route('activities.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" id="type"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="note" {{ old('type') === 'note' ? 'selected' : '' }}>Note</option>
                    <option value="milestone" {{ old('type') === 'milestone' ? 'selected' : '' }}>Milestone</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Save Activity
            </button>
        </form>
    </div>
</x-layout>
