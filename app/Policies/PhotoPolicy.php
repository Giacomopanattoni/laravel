<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any photos.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the photo.
     *
     * @param  App\Models\User  $user
     * @param  \App\Photo  $photo
     * @return mixed
     */
    public function view(User $user, Photo $photo)
    {
        return $user->id == $photo->album->user_id;
    }

    /**
     * Determine whether the user can create photos.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return 1;
    }

    /**
     * Determine whether the user can update the photo.
     *
     * @param  App\Models\User  $user
     * @param  \App\Photo  $photo
     * @return mixed
     */
    public function update(User $user, Photo $photo)
    {
        return $user->id == $photo->album->user_id;
    }

    /**
     * Determine whether the user can delete the photo.
     *
     * @param  App\Models\User  $user
     * @param  \App\Photo  $photo
     * @return mixed
     */
    public function delete(User $user, Photo $photo)
    {
        return $user->id == $photo->album->user_id;
    }

    /**
     * Determine whether the user can restore the photo.
     *
     * @param  App\Models\User  $user
     * @param  \App\Photo  $photo
     * @return mixed
     */
    public function restore(User $user, Photo $photo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the photo.
     *
     * @param  App\Models\User  $user
     * @param  \App\Photo  $photo
     * @return mixed
     */
    public function forceDelete(User $user, Photo $photo)
    {
        //
    }
}
