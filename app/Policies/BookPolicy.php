<?php

namespace App\Policies;

use App\User;
use App\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can update the book.
     * Authorizes users who uploaded the book to update it
     * Authorizes admins to update any book
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
       if($user->role=="admin" || $user->id == $book->user_id){
           return true;
       }
       return false;
    }

    /**
     * Determine whether the user can delete the book.
     * Authorizes simple users to delete only the books they uploaded.
     * Authorizes admins to delete any book.
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        if($user->role=="admin" || $user->id == $book->user_id){
            return true;
        }
        return false;
    }
}
