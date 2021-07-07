<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id' => '1',
                'title' => 'user_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '2',
                'title' => 'user_edit',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '3',
                'title' => 'role_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '4',
                'title' => 'role_edit',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '5',
                'title' => 'role_create',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '6',
                'title' => 'permission_create',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '7',
                'title' => 'permission_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '8',
                'title' => 'subscription_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '9',
                'title' => 'subscription_export',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '10',
                'title' => 'subscription_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '11',
                'title' => 'post_create',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '12',
                'title' => 'post_edit',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '13',
                'title' => 'post_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '14',
                'title' => 'post_trash',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '15',
                'title' => 'post_restore',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '16',
                'title' => 'post_publish',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '17',
                'title' => 'post_view',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '18',
                'title' => 'category_create',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '19',
                'title' => 'category_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '20',
                'title' => 'category_edit',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '21',
                'title' => 'tag_edit',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '22',
                'title' => 'tag_create',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '23',
                'title' => 'tag_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '24',
                'title' => 'comment_delete',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '25',
                'title' => 'dashboard_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '26',
                'title' => 'user_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '27',
                'title' => 'role_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '28',
                'title' => 'permission_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '29',
                'title' => 'category_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '30',
                'title' => 'tag_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '31',
                'title' => 'comment_access',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
            [
                'id' => '32',
                'title' => 'post_trash_list',
                'created_at' => '2020-02-24 22:34:18',
                'updated_at' => '2020-02-24 22:34:18',
            ],
        ];
        Permission::insert($permissions);
    }
}
