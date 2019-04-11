<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 // Permisos
         $permission = [
        [
                'name' => 'user-list',
                'display_name' => 'listar usuarios',
                'description' => 'EL usuario puede visualizar los usuarios'
            ],
              [
                'name' => 'user-create',
                'display_name' => 'Crear Usuarios',
                'description' => 'El usuario puede crear usuarios'
            ],

            [
                'name' => 'user-update',
                'display_name' => 'Actualizar Usuarios',
                'description' => 'El usuario puede modificar Usuarios'
            ],
            [
                'name' => 'user-delete',
                'display_name' => 'Eliminar Usuarios',
                'description' => 'El usuario puede eliminar Usuarios'
            ],

              [
                'name' => 'role-list',
                'display_name' => 'listar roles',
                'description' => 'El usuario puede visualizar los roles'
            ],

            [
                'name' => 'role-create',
                'display_name' => 'Crear rol',
                'description' => 'La persona puede crear roles'
            ],
            [
                'name' => 'role-update',
                'display_name' => 'Actualizar Roles',
                'description' => 'El usuario puede actualizar roles'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Borrar roles',
                'description' => 'El usuario puede borrar roles'
            ],
              [
                'name' => 'logs-list',
                'display_name' => 'Ver Logs',
                'description' => 'el usuario puede ver los logs de inicio de sesión de los usuarios'
            ],
            [
                'name' => 'logs-list-viever',
                'display_name' => 'Ver Logs del sistema',
                'description' => 'el usuario puede ver los logs del sistema'
            ],
          [
                'name' => 'backup-admin',
                'display_name' => 'Administrar bacups',
                'description' => 'el usuario puede ver los backups'
            ],
        ];
        foreach ($permission as $key => $value) {
            Permission::create($value);
        }





// Permisos





        // $this->call(UsersTableSeeder::class);
        DB::table('users')->delete();
        //1) Create Admin Role
        $role = ['name' => 'Admin', 'display_name' => 'Admin', 'description' => 'Full Permission','slug' => 'Admin'];
        $role = Role::create($role);
        //2) Set Role Permissions
        // Get all permission, swift through and attach them to the role
        $permission = Permission::get();
        foreach ($permission as $key => $value) {
            $role->attachPermission($value);
        }
        //3) Create Admin User
        
       $user = [
        'name' => 'rodrigo',
        'email' => 'admin@outlook.com', 
        'password' => Hash::make('admin123456789'),
        'slug' => 'rodrigo',
        'status' => 1,
        'gender' => 'h',
        'phone' => 123456789,
        'first_name' => 'luis',
        'last_name' =>'parra',

    ];


        $user = User::create($user);
        //4) Set User Role
        $user->attachRole($role);
    }
}