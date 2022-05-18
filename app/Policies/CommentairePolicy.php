<?php

namespace App\Policies;

use App\Models\Commentaire;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentairePolicy
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
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Commentaire $commentaire)
    {
        if ( $user->id == $commentaire->user_id ){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Commentaire $commentaire)
    {
        if ( $user->id == $commentaire->user_id || $user->id == $commentaire->message->user_id ){
            return true;
        } else {
            return false;
        }
        
    }

    
}
