<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function postsTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('posts', [
            'id',
            'title',
            'description',
            'body',
            'slug',
            'published',
            'viewed',
            'time_to_read',
            'user_id',
            'category_id',
            'photo_source'
        ]), 1);
    }

    /** @test */
    public function likesTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('likes', [
            'id',
            'type',
            'likeable_type',
            'likeable_id',
            'user_id'
        ]), 1);
    }

    /** @test */
    public function usersTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('users', [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'provider',
            'provider_id',
            'last_login_at',
            'last_login_ip_address'
        ]), 1);
    }

    /** @test */
    public function categoriesTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('categories', [
            'id',
            'title'
        ]), 1);
    }

    /** @test */
    public function photosTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('photos', [
            'id',
            'photoable_type',
            'photoable_id',
            'path'
        ]), 1);
    }

    /** @test */
    public function tagsTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('tags', [
            'id',
            'title'
        ]), 1);
    }

    /** @test */
    public function commentsTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('comments', [
            'id',
            'comment_id',
            'body',
            'post_id',
            'user_id'
        ]), 1);
    }

    /** @test */
    public function postTagTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('post_tag', [
            'id',
            'tag_id',
            'post_id'
        ]), 1);
    }

    /** @test */
    public function rolesTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('roles', [
            'id',
            'title'
        ]), 1);
    }

    /** @test */
    public function permissionsTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('permissions', [
            'id',
            'title'
        ]), 1);
    }

    /** @test */
    public function permissionRoleTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('permission_role', [
            'id',
            'permission_id',
            'role_id'
        ]), 1);
    }

    /** @test */
    public function roleUserTagTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('role_user', [
            'id',
            'role_id',
            'user_id'
        ]), 1);
    }

    /** @test */
    public function subscriptionsTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('subscriptions', [
            'id',
            'email',
            'remember_token'
        ]), 1);
    }

    /** @test */
    public function passwordResetsTableHasExpectedColumns()
    {
        $this->assertTrue(Schema::hasColumns('password_resets', [
            'email',
            'token'
        ]), 1);
    }
}
