<?php

namespace Database\Seeders;

use App\Models\Category as ModelsCategory;
use App\Models\IPuser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'user'
        ]);
        Role::create([
            'name' => 'writer'
        ]);
        Role::create([
            'name' => 'konsultan'
        ]);
        $addrole = Permission::create([
            'name' => 'add-role'
        ]);
        $editrole = Permission::create([
            'name' => 'edit-role'
        ]);
        $deleterole = Permission::create([
            'name' => 'delete-role'
        ]);
        $addpermission = Permission::create([
            'name' => 'add-permission'
        ]);
        $editpermission = Permission::create([
            'name' => 'edit-permission'
        ]);
        $deletepermission = Permission::create([
            'name' => 'delete-permission'
        ]);
        $edituser = Permission::create([
            'name' => 'edit-user'
        ]);
        $giveroleuser = Permission::create([
            'name' => 'giverole-user'
        ]);
        $givepermissionuser = Permission::create([
            'name' => 'givepermission-user'
        ]);
        $blokuser = Permission::create([
            'name' => 'blok-user'
        ]);
        $deleteuser = Permission::create([
            'name' => 'delete-user'
        ]);
        $unpublishblog = Permission::create([
            'name' => 'unpublish-blog'
        ]);
        $publishblog = Permission::create([
            'name' => 'publish-blog'
        ]);
        $editblog = Permission::create([
            'name' => 'edit-blog'
        ]);
        $deleteblog = Permission::create([
            'name' => 'delete-blog'
        ]);
        $historyblog = Permission::create([
            'name' => 'history-blog'
        ]);
        $deletecategory = Permission::create([
            'name' => 'delete-category'
        ]);
        $addblog = Permission::create([
            'name' => 'add-blog'
        ]);
        $addstory = Permission::create([
            'name' => 'add-story'
        ]);
        $publishstory = Permission::create([
            'name' => 'publish-story'
        ]);
        $unpublishstory = Permission::create([
            'name' => 'unpublish-story'
        ]);
        $editstory = Permission::create([
            'name' => 'edit-story'
        ]);
        $deletestory = Permission::create([
            'name' => 'delete-story'
        ]);
        $showstory = Permission::create([
            'name' => 'show-story'
        ]);
        $admin->givePermissionTo(['add-role', 'edit-role', 'delete-role', 'add-permission', 'edit-permission', 'delete-permission']);

        ModelsCategory::create([
            'name' => 'mental health',
            'slug' => 'mental-health'
        ]);
        $ip = IPuser::create([
            'ip_user' => "127.0.0.1",
            'active' => "1"
        ]);
        $user = User::create([
            'name' => 'lintang lazuardi',
            'ip_user' => 1,
            'password' => bcrypt('linlaz11')
        ]);
        $user->assignRole('admin');
    }
}
