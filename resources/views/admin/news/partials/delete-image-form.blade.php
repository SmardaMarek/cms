<form action="{{ route('news.image.delete', $image->id) }}" method="POST" onsubmit="return confirm('Opravdu chcete smazat tento obrázek?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-white bg-red-600 rounded p-1 text-xs"> 
        <i class="fa fa-trash" aria-hidden="true"></i> Smazat
    </button>
</form>