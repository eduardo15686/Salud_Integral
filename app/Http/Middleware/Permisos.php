<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Permiso;
use Auth;

class Permisos
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

	public function handle($request, Closure $next=NULL, $params=NULL)
    {
        if (Auth::check()) {
        	$permisos_perfil = User::where('id',Auth::id())            
                ->with('perfil')
                ->get()
                ->toarray();

            $array_permisos = explode(',', $permisos_perfil[0]['perfil']['permisos_id']);
            
            $permisos_perfil[0]['permisos'] = Permiso::whereIn('id',$array_permisos)
                ->where('estatus','Activo')
                ->orderBy('parent_id', 'asc')
                ->orderBy('orden', 'asc')
                ->get()
                ->toarray();       

            $request->session()->put('useradmin.permisos.0', $permisos_perfil[0]['permisos']);

            
            $permisosPrev = explode('-',$params);
    		$listaPermisos = \Session::get('useradmin.permisos.0');		
    				
    		$permisos = explode('_',$permisosPrev[1]);						
    		if($listaPermisos != ''){
    			foreach($permisos as $key => $value){
    				$existe = array_search($permisos[$key], array_column($listaPermisos, 'id'));				
    				if($existe !== false){								
    					$request->session()->forget('useradmin.permisoActual');
    					$request->session()->forget('useradmin.idModulo');				
    					$request->session()->push('useradmin.permisoActual', $permisos[$key]);
    					$request->session()->push('useradmin.idModulo', $permisosPrev[0]);								
    			    	return $next($request);
    				}
    			}
    		}else{			
    	        return \Redirect::intended('/login');
    		}			
        }    
    	else{
            return redirect('/login');
        }    
	}
}
