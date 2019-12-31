<?php declare(strict_types=1);

namespace LeafCms\FileCenter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use LeafCms\FileCenter\Models\Image;

class ImageController
{
    public function index()
    {
        $images = Image::all();

        return view('file-center.images.index', [
            'images' => $images,
        ]);
    }

    public function create()
    {
        return view('file-center.images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        /** @var UploadedFile $file */
        $file = $request->file;

        $filename = str_replace(['.jpeg', '.jpg', '.png', '.gif'], '', $file->getClientOriginalName());

        $request->request->add(['filename' => $filename]);

        $request->validate([
            'filename' => 'required|max:255|unique:file_center_images',
        ]);

        /** @var Image $image */
        $image = Image::query()->create([
            'path'      => 'images',
            'filename'  => str_replace(['.jpeg', '.jpg', '.png', '.gif'], '', $file->getClientOriginalName()),
            'extension' => $file->getClientOriginalExtension(),
        ]);

        $file->storeAs('images', $image->fullFilename());

        return redirect(route('dashboard.file-center.images.index'))->with('flash-success', 'Obraz został dodany.');
    }

    public function edit(Image $image)
    {
        return view('file-center.images.edit', [
            'image' => $image,
        ]);
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'filename' => 'required|max:255|unique:file_center_images,filename,' . $image->id,
        ]);

        if ($image->filename === $request->input('filename')) {
            return redirect(route('dashboard.file-center.images.index'))->with('flash-success', 'Obraz został zaktualizowany.');
        }

        $oldPath = $image->fullPath();

        $image->update([
            'filename' => $request->input('filename')
        ]);

        Storage::disk('local')->move($oldPath, $image->fullPath());

        return redirect(route('dashboard.file-center.images.index'))->with('flash-success', 'Obraz został zaktualizowany.');
    }

    public function destroy(Image $image)
    {
        $image->forceDelete();

        if (Storage::disk('local')->exists($image->fullPath())) {
            Storage::disk('local')->delete($image->fullPath());
        }

        return redirect(route('dashboard.file-center.images.store'))->with('flash-success', 'Obraz został usunięty.');
    }
}
