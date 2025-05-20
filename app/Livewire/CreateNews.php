<?php
namespace App\Livewire;

use Livewire\Component;
use App\Http\Requests\NewsRequest;
use App\Services\NewsService;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;


class CreateNews extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $perex = '';
    public string $content = '';
    public ?Carbon $published_at = null;
    public ?UploadedFile $main_image = null;
    public array $gallery_images = [];

    protected function rules(){
        return (new NewsRequest())->rules();
    }

    public function submit(NewsService $newsService)
    {
        $validatedData = $this->validate();

        $newsService->create(
            $validatedData,
            $this->main_image,
            $this->gallery_images
        );


        session()->flash('message', 'Aktualita byla úspěšně vytvořena.');
        return redirect()->route('news');
    }

    public function render()
    {
        return view('admin.news.livewire.create-form');
    }

}

//TODO: create unit test
