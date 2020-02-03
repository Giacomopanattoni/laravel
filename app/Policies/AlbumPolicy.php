<?php

namespace App\Policies;

use App\Models\Album;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any albums.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the album.
     *
     * @param  App\Models\User  $user
     * @param  \App\Album  $album
     * @return mixed
     */
    public function view(User $user, Album $album)
    {
        return $user->id == $album->user_id;
    }

    /**
     * Determine whether the user can create albums.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the album.
     *
     * @param  App\Models\User  $user
     * @param  \App\Album  $album
     * @return mixed
     */
    public function update(User $user, Album $album)
    {
        return $user->id == $album->user_id;
    }

    /**
     * Determine whether the user can delete the album.
     *
     * @param  App\Models\User  $user
     * @param  \App\Album  $album
     * @return mixed
     */
    public function delete(User $user, Album $album)
    {
        return $user->id == $album->user_id;
    }

    /**
     * Determine whether the user can restore the album.
     *
     * @param  App\Models\User  $user
     * @param  \App\Album  $album
     * @return mixed
     */
    public function restore(User $user, Album $album)
    {
        return $user->id == $album->user_id;
    }

    /**
     * Determine whether the user can permanently delete the album.
     *
     * @param  App\Models\User  $user
     * @param  \App\Album  $album
     * @return mixed
     */
    public function forceDelete(User $user, Album $album)
    {
        return $user->id == $album->user_id;
    }
}
