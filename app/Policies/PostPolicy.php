<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        return auth()->user()->can('dashboard_access');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view()
    {
        return auth()->user()->can('post_view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create()
    {
        return auth()->user()->can('post_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        return auth()->user()->can('post_edit') &&
            $user->id === $post->user->id ||
            $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Post $post)
    {
        return auth()->user()->can('post_trash') &&
            $user->id === $post->user->id ||
            $user->is_admin;
    }

    /**
     * Determine whether the user can view post trash.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewTrashList()
    {
        return auth()->user()->can('post_trash_list');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore()
    {
        return auth()->user()->can('post_restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete()
    {
        return auth()->user()->can('post_delete');
    }

    /**
     * Determine whether the user can publish post.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function publish()
    {
        return auth()->user()->can('post_publish');
    }
}
