<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     //aca vamos a compartir por props a todos nuestros componentes la informacion que nos interesa 
    public function share(Request $request): array
    {  

        //vamos a compartir los roles y permisos del usuario para que toda la aplicacion acceda a esa informacion y 
        //y decidir que informacion muestra 

        /*esto es para no estar pasando constantemente la informacion sobre los roles y los permisosde forma explicita 

        
        */
        return array_merge(parent::share($request), [
          
            'user.roles'=>$request->user()?$request->user()->roles->pluck('name'):[],
            'user.permissions'=> $request->user()? $request->user()->getPermissionsViaRoles()->pluck('name'):[],
        ]);
    }
}
