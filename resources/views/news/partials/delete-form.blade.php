<form action="{{ route('news.delete', $new->id) }}" method="POST" onsubmit="return confirm('Opravdu chcete smazat tuto aktualitu?');" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600">
        <i class="fa fa-trash" aria-hidden="true"></i> Smazat
    </button>
</form>