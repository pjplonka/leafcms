<?php declare(strict_types=1);

namespace LeafCms\Blog\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LeafCms\Blog\Models\Tag;

class TagController
{
    public function index()
    {
        $tags = Tag::all();

        return view('blog.tags.index', [
            'tags' => $tags,
        ]);
    }

    public function create()
    {
        return view('blog.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:blog_tags',
        ]);

        Tag::query()->create([
            'name' => $request->input('name'),
            'slug'  => Str::slug($request->input('name')),
        ]);

        return redirect(route('dashboard.blog.tags.index'))->with('flash-success', 'Tag został dodany.');
    }

    public function edit(Tag $tag)
    {
        return view('blog.tags.edit', [
            'tag'    => $tag,
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:255|unique:blog_tags,name,' . $tag->id,
            'slug'  => 'required|max:255|unique:blog_tags,slug,' . $tag->id,
        ]);

        $tag->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect(route('dashboard.blog.tags.index'))->with('flash-success', 'Tag został zaktualizowany.');
    }

    public function destroy(Tag $tag)
    {
        $tag->forceDelete();

        return redirect(route('dashboard.blog.tags.store'))->with('flash-success', 'Tag został usunięty.');
    }
}
