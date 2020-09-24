<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class RolesController extends Controller
{
    public function getListarRoles(Request $request){
        //return $request;
        if(!$request->ajax()) return redirect('/');

        $cNombre  = $request->cNombre;
        $cSlug = $request->cSlug;
        
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cSlug = ($cSlug == NULL) ? ($cSlug = '') : $cSlug;
        

        $rpta = DB::select('call sp_Rol_getListarRoles ( ?, ?)', [
            $cNombre,
            $cSlug
        ]);
        return $rpta;
    }

    public function getListarPermisoByRol(Request $request){
        if(!$request->ajax()) return redirect('/');

        $rpta = DB::select('call sp_Rol_getListarPermisoByRol');
        return $rpta;
    }

    public function setRegistrarRolPermisos(Request $request){
        if(!$request->ajax()) return redirect('/');

        $cNombre    = $request->cNombre;
        $cSlug      = $request->cSlug;
        
        $cNombre    = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cSlug      = ($cSlug == NULL) ? ($cSlug = '') : $cSlug;
        

        
        try{
            DB::beginTransaction();
            $rpta = DB::select('call sp_Rol_setRegistrarRol ( ?, ?)', [
                $cNombre,
                $cSlug
            ]);
    
            $nIdRol = $rpta[0]->nIdRol;
            $listPermisos = $request->listPermisosFilter;
            $listPermisosSize = sizeof($listPermisos);
            if($listPermisosSize > 0){
                foreach($listPermisos as $key => $value){
                    if($value['checked'] == true){
                        DB::select('call sp_Rol_setRegistrarRolPermiso (?, ?)',[
                            $nIdRol,
                            $value['id']
                        ]);
                    }
                }
            }
            DB::commit();
        }catch(\Throwable $e){
            DB::rollBack();
        }
    }
}
