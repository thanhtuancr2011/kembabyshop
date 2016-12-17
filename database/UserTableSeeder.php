<?php
namespace Database;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;
use App\Models\CategoryModel;
use Bican\Roles\Models\Role as RoleModel;
use Bican\Roles\Models\Permission as PermissionModel;
use DB;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@kembabyshop.com')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('categories')->delete();
        
        // Create role for admin
        $adminRole = RoleModel::create([
            'name' => 'Super Admin',
            'slug' => 'super.admin',
            'description' => 'Permission of admin user', // optional
            'level' => 1, // optional, set to 1 by default
        ]);

        // Create role for mod
        $modRole = RoleModel::create([
            'name' => 'Super mod',
            'slug' => 'super.mod',
            'description' => 'Permission of mod user', // optional
            'level' => 1, // optional, set to 1 by default
        ]);

        // Create permission for admin
        $adminPermission = PermissionModel::create([
            'name' => 'User Admin',
            'slug' => 'user.admin',
            'description' => 'User Administrator', // optional
        ]);

        // Create permission for admin
        $modPermission = PermissionModel::create([
            'name' => 'User Mod',
            'slug' => 'user.mod',
            'description' => 'User Moderator', // optional
        ]);
        
        // Create user and assign role is admin
        $userAdmin = new UserModel([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@kembabyshop.com',
            'remember_token' => str_random(40),
            'password' =>bcrypt('admin')
        ]);

        // Create the root category
        $category = new CategoryModel([
            'name' => 'Danh mục gốc',
            'sort_order' => '0',
            'keywords' => 'danh-muc-goc',
            'description' => 'Danh mục gốc',
            'alias' => 'danh_muc_goc',
            'parent_id' => 0
        ]);

        /* Save, attach role and permission for user admin, and create category */
        $userAdmin->save();

        $userAdmin->attachRole($adminRole);

        $userAdmin->attachPermission($adminPermission);

        $category->save();
    }

}
