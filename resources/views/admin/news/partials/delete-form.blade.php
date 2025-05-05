<form action="{{ route('news.delete', $new->id) }}" method="POST" onsubmit="return confirm('Opravdu chcete smazat tuto aktualitu?');" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="@if ($index === false) bg-red-600 rounded-lg p-2 text-white @else text-red-600  @endif ">
        <i class="fa fa-trash" aria-hidden="true"></i> Smazat
    </button>
</form>