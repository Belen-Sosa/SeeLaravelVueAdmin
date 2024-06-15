<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_root= Role::create(['name'=>'root']);
        $role_admin= Role::create(['name'=>'admin']);
        $role_student= Role::create(['name'=>'student']);

        //creando permisos y sus nombres 
        //permiso creacion de usuarios 

        $permission_create_admin= Permission::create(['name'=>'create admin']) ;  
        $permission_read_admin= Permission::create(['name'=>'read admin']) ;     
        $permission_update_admin= Permission::create(['name'=>'update admin']) ;
        $permission_delete_admin= Permission::create(['name'=>'delete admin']) ;
        //permisos carreras

        
        $permission_create_career= Permission::create(['name'=>'create career']) ;  
        $permission_read_career= Permission::create(['name'=>'read career']) ;     
        $permission_update_career= Permission::create(['name'=>'update career']) ;
        $permission_delete_career= Permission::create(['name'=>'delete career']) ;

        //permisos profesores

        
        $permission_create_teacher= Permission::create(['name'=>'create teacher']) ;  
        $permission_read_teacher= Permission::create(['name'=>'read teacher']) ;     
        $permission_update_teacher= Permission::create(['name'=>'update teacher']) ;
        $permission_delete_teacher= Permission::create(['name'=>'delete teacher']) ;

        //permisos materias

                
        $permission_create_subject= Permission::create(['name'=>'create subject']) ;  
        $permission_read_subject= Permission::create(['name'=>'read subject']) ;     
        $permission_update_subject= Permission::create(['name'=>'update subject']) ;
        $permission_delete_subject= Permission::create(['name'=>'delete subject']) ;


        
        //permisos estudiantes
 
        $permission_create_student= Permission::create(['name'=>'create student']) ;  
        $permission_read_student= Permission::create(['name'=>'read student']) ;     
        $permission_update_student= Permission::create(['name'=>'update student']) ;
        $permission_delete_student= Permission::create(['name'=>'delete student']) ;

        

        //permisos encuestas

                
        $permission_create_survey= Permission::create(['name'=>'create survey']) ;  
        $permission_read_survey= Permission::create(['name'=>'read survey']) ;     
        $permission_update_survey= Permission::create(['name'=>'update survey']) ;
        $permission_delete_survey= Permission::create(['name'=>'delete survey']) ;

        $permission_post_survey= Permission::create(['name'=>'post survey']) ;
        $permission_finish_survey= Permission::create(['name'=>'finish survey']) ;
        $permission_preview_survey= Permission::create(['name'=>'preview survey']) ;
        $permission_result_survey= Permission::create(['name'=>'result survey']) ;



        //permisos preguntas


                
        $permission_create_question= Permission::create(['name'=>'create question']) ;  
        $permission_read_question= Permission::create(['name'=>'read question']) ;     
        $permission_update_question= Permission::create(['name'=>'update question']) ;
        $permission_delete_question= Permission::create(['name'=>'delete question']) ;


        

        //permisos opciones


                
        $permission_create_option= Permission::create(['name'=>'create option']) ;  
        $permission_read_option= Permission::create(['name'=>'read option']) ;     
        $permission_update_option= Permission::create(['name'=>'update option']) ;
        $permission_delete_option= Permission::create(['name'=>'delete option']) ;
    
        $permissions_root =[
            $permission_create_admin,  $permission_read_admin,  $permission_update_admin,  $permission_delete_admin,
         $permission_create_career, $permission_read_career, $permission_update_career,  $permission_delete_career,
         $permission_create_teacher, $permission_read_teacher, $permission_update_teacher,  $permission_delete_teacher,
         $permission_create_subject, $permission_read_subject, $permission_update_subject,$permission_delete_subject,
         $permission_create_student, $permission_read_student,  $permission_update_student, $permission_delete_student,
         $permission_create_survey, $permission_read_survey,  $permission_update_survey,$permission_delete_survey,$permission_post_survey, $permission_finish_survey,
         $permission_preview_survey, $permission_result_survey,
         $permission_create_question,  $permission_read_question, $permission_update_question,$permission_delete_question,
         $permission_create_option,   $permission_read_option, $permission_update_option, $permission_delete_option

        ];

        $permission_admin=[
        
            $permission_create_teacher, $permission_read_teacher, $permission_update_teacher,  
            $permission_create_subject, $permission_read_subject, $permission_update_subject,
            $permission_create_student, $permission_read_student,  $permission_update_student, 
            $permission_create_survey, $permission_read_survey,  $permission_update_survey,$permission_delete_survey,$permission_post_survey, $permission_finish_survey,
            $permission_preview_survey, $permission_result_survey,
            $permission_create_question,  $permission_read_question, $permission_update_question,$permission_delete_question,
            $permission_create_option,   $permission_read_option, $permission_update_option, $permission_delete_option
   
       
        ];

        $permissions_student= [
            $permission_read_survey   

        ];
        

        //asignando permisos

        $role_root->syncPermissions($permissions_root);
        $role_admin->syncPermissions($permission_admin);
        $role_student->syncPermissions($permissions_student); 

    }
}
