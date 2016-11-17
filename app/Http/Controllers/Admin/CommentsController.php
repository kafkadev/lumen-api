<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->viewData['pageTitle'] = 'Comments';
        $this->viewData['statusSelectOptions'] = [
            0 => 'Unread',
            1 => 'Read',
        ];
    }

    public function index()
    {
        $this->viewData['comments'] = Comment::all();
        return view('admin.comments.index', $this->viewData);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->seen = intval($request->seen);
        $comment->save();
        $_SESSION['success'] = 'Update Comment successfully!';
        return redirect('admin/comments');
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        $_SESSION['success'] = 'Delete Comment successfully!';
        return redirect('admin/comments');
    }
}
