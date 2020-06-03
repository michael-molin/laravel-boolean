<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


use App\Page;
use App\Category;
use App\Tag;
use App\Photo;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Creo una variabile page in cui ottengo una lista delle Page ordinate per Updated e con paginazione 25 elementi per pagina, poi passo il tutto alla view
        $pages= Page::orderBy('updated_at', 'DESC' )->paginate(25);
        return view('admin.pages.index' , compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // creo 3 variabili corrispondenti con tutti i dati presi dai model e passo questi valori alla pagina di creazione
        $categories = Category::all();
        $photos = Photo::all();
        $tags = Tag::all();

        return view('admin.pages.create' , compact('categories' , 'photos' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        // $validator = Validator::make($data, [
        //     'title' => 'required',
        //     'summary' => 'required',
        //     'user_id' => 'required',
        //     'category_id' => 'required',
        //     'tag_id' => 'required'
        // ]);
        //
        // if ($validator->fails()) {
        //     return redirect()->route('admin.pages.create')
        //     ->withErrors($validator)
        //     ->withInput();
        // }

        $page= new Page;
        $page->fill($data);
        $updated = $page->save();
        dd($updated);
        if(!$updated) {
            abort('404');
        }

        if(isset($data['tags'])) {
            $page->tags()->attach($data['tags']);
        }

        if (isset($data['photos'])) {
            $page->photos()->attach($data['photos']);
        }

        return redirect()->route('admin.pages.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFails($id);

        return view('admin.pages.show' , compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFails($id);

        $user = Auth::id();

        if($page->user_id != $user) {
                return redirect()->back();
            }

        $categories = Category::all();
        $photos = Photo::all();
        $tags = Tag::all();

        return view('admin.pages.create' , compact('page' , 'categories' , 'photos' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFails($id);

        $user = Auth::id();

        if($page->user_id != $user) {
                return redirect()->back();
            }
        $data = $request::all();

        $validator = Validator::make($data, [
            'title' => 'required',
            'summary' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pages.create')
            ->withErrors($validator)
            ->withInput();
        }

        $page->fill($data);
        $updated = $page->update();

        if(!$updated) {
            abort('404');
        }

        if(isset($data['tags'])) {
            $page->tags()->synch($data['tags']);
        }

        if (isset($data['photos'])) {
            $page->photos()->synch($data['photos']);
        }

        return redirect()->route('admin.pages.show', $page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFails($id);

        $user = Auth::id();

        if($page->user_id != $user) {
                return redirect()->back();
            }

        $page->tags()->detach();
        $page->photos()->detach();
        $page->delete();

        return redirect()->back();
    }
}
