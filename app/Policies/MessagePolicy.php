<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

   public function before(User $user){
    if($user->isAdmin()){
        return true;
    }
   }
  

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Auth::user();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Message $message)
    {
        // On vérifie si le user connecté a e droit de modifier le message
        if ( $user->id == $message->user_id ){
            return true;
        } else {
            return false;
        }
        // return $user->id == $message->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Message $message)
    {
        if ( $user->id == $message->user_id  ){
            return true;
        } else {
            return false;
        }

    }

    
}
