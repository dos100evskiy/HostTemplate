<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MainController extends Controller
{
    public function home() {
        return view('home');
    }
    
    public function members() {
        $members = new Book();
        $books = DB::table('books')
                    ->join('users', 'books.member_id', '=', 'users.id')
                    ->select('books.id', 'member_id', 'name', 'email', 'author', 'book') 
                    ->orderBy('name')
                    ->get();
                $file = 'data.txt';
        
                file_put_contents($file, $books);
        return view('members', ['books' => $books->all()]);
    }

    public function order() {
        return view('order');
    }

    public function order_check(Request $request) {
        if (Auth::user()->is_admin == 1)
        {
            $valid = $request->validate([
                'email' => 'required|email',
                'author' => 'required|min:4|max:50',
                'book' => 'required|min:4|max:50'
            ]);
            $cur_member_id = DB::table('users')
                        ->where('email', '=', $request->input('email'))
                        ->value('id');
            /*if ($cur_member_id == null)
            {
                Log::warning('admin failed to order, user with email '.$request->input('email').' not found'); //переписать, чтобы в логе участвовала книга и имя юзера
                return redirect()->route('userNotFound');
            }*/
            //catch(\Illuminate\Database\QueryException $e) ловить этот экзепшн в методе $book->save();
            $book = new Book();
            $book->author = $request->input('author');
            $book->book = $request->input('book');
            $book->member_id = $cur_member_id;
            try{
            $book->save();
            } catch(\Illuminate\Database\QueryException $e)
            {
                Log::warning('admin failed to order '.$book->book.', user with email '.$request->input('email').' not found'); //переписать, чтобы в логе участвовала книга и имя юзера
                return redirect()->route('userNotFound');
            }
            Log::info('Admin '.Auth::user()->name.' order book '.$book->book.' for user id = '.$cur_member_id);
            return redirect()->route('home'); 
        }
        else
        {
        $valid = $request->validate([
            'author' => 'required|min:4|max:50',
            'book' => 'required|min:4|max:50'
        ]);
        $cur_member_id = Auth::user()->id;
        }
        $book = new Book();
        $book->author = $request->input('author');
        $book->book = $request->input('book');
        $book->member_id = $cur_member_id;
        $book->save();
        Log::info('User '.Auth::user()->name.' order book '.$book->book);
        return redirect()->route('home'); 
    }

    public function member_check(Request $id) {
        $id = key($id->all());

        $book = DB::table('books')->where('id', '=', $id)
                                  ->value('book');
        $user_id = DB::table('books')->where('id', '=', $id)
                                     ->value('member_id');
        $order_user = DB::table('books')
                                        ->join('users', 'member_id', '=', 'users.id')
                                        ->where('users.id', '=', $user_id)
                                        ->value('name');

        DB::table('books')->where('id', '=', $id)->delete();
        Log::info('Admin '.Auth::user()->name.' delete order for book: '.$book.' of user '.$order_user); 
        return redirect()->route('home');
    }
}
