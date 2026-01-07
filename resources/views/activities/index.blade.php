<x-layout title="Activities">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Activities</h1>
        <a href="{{ route('activities.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Add Activity
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($activities->isEmpty())
        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
            No activities yet. Start by adding one!
        </div>
    @else
        <div class="space-y-4">
            @foreach($activities as $activity)
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $activity->type === 'milestone' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($activity->type) }}
                            </span>
                            <h2 class="text-lg font-semibold text-gray-800 mt-2">
                                <a href="{{ route('activities.show', $activity) }}" class="hover:text-blue-600">
                                    {{ $activity->title }}
                                </a>
                            </h2>
                            @if($activity->description)
                                <p class="text-gray-600 mt-1">{{ Str::limit($activity->description, 100) }}</p>
                            @endif
                            <p class="text-sm text-gray-400 mt-2">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('activities.edit', $activity) }}" class="text-gray-500 hover:text-blue-600">
                                Edit
                            </a>
                            <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Delete this activity?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layout>
