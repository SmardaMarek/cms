@if (!$new->published_at)
<form action="{{ route('news.publish', $new->id) }}" method="POST" class="inline">
    @csrf
    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
        Publikovat
    </button>
</form>
@else
<span class="text-sm text-gray-500">Publikováno: {{ $new->published_at }}</span>
@endif