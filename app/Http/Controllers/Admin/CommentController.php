<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditCommentRequest;
use App\Http\Requests\Admin\CreateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::paginate(10);

        return view('admin.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // جلب كل الفئات من قاعدة البيانات
        $categories = Category::all();

        // تمرير الفئات إلى العرض
        return view('admin.comment.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);


       
        Comment::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.comment.index')->with('success', 'Comment added successfully');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(EditCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return redirect()->route('admin.comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // Assuming comments have related posts, adjust this logic according to your actual model relationships
        foreach ($comment->posts as $post) {
            $post->comments()->detach($comment->id);
        }

        if (! $comment->posts()->count()) {
            $comment->delete();
        }

        return redirect()->route('admin.comment.index');
    }
}
