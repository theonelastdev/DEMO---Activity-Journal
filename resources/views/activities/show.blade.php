<x-layout title="{{ $activity->title }}">
    <div class="mb-6">
        <a href="{{ route('activities.index') }}" class="text-blue-600 hover:underline">&larr; Back to Activities</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-4">
            <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $activity->type === 'milestone' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                {{ ucfirst($activity->type) }}
            </span>
            <div class="flex space-x-4">
                <a href="{{ route('activities.edit', $activity) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Delete this activity?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $activity->title }}</h1>
        <p class="text-sm text-gray-400 mb-6">{{ $activity->created_at->format('F j, Y \a\t g:i A') }}</p>

        @if($activity->description)
            <div class="prose text-gray-700">
                {{ $activity->description }}
            </div>
        @else
            <p class="text-gray-500 italic">No description provided.</p>
        @endif
    </div>
</x-layout>
