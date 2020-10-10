<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsersController extends Controller
{
    public function getListarUsuarios(Request $request){
        //return $request;
        if(!$request->ajax()) return redirect('/');

        $nIdUsuario  = $request->nIdUsuario;
        $cNombre  = $request->cNombre;
        $cUsuario = $request->cUsuario;
        $cCorreo  = $request->cCorreo;
        $cEstado  = $request->cEstado;

        $nIdUsuario = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;
        $cNombre = ($cNombre == NULL) ? ($cNombre = '') : $cNombre;
        $cUsuario = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cEstado = ($cEstado == NULL) ? ($cEstado = '') : $cEstado;

        $rpta = DB::select('call sp_Usuario_getListarUsuarios ( ?, ?, ?, ?, ?)', [
            $nIdUsuario,
            $cNombre,
            $cUsuario,
            $cCorreo,
            $cEstado
        ]);
        return $rpta;
    }

    public function  setRegistrarUsuario(Request $request){

        if(!$request->ajax()) return redirect('/');

        $cPrimerNombre  = $request->cPrimerNombre;
        $cSegundoNombre = $request->cSegundoNombre;
        $cApellido      = $request->cApellido;
        $cUsuario       = $request->cUsuario;
        $cCorreo        = $request->cCorreo;
        $cContrasena    = Hash::make($request->cContrasena);
        $oFotografia    = $request->oFotografia;

        $cPrimerNombre  = ($cPrimerNombre == NULL) ? ($cPrimerNombre = '') : $cPrimerNombre;
        $cSegundoNombre = ($cSegundoNombre == NULL) ? ($cSegundoNombre = '') : $cSegundoNombre;
        $cApellido      = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
        $cUsuario       = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
        $cCorreo        = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContrasena    = ($cContrasena == NULL) ? ($cContrasena = '') : $cContrasena;
        $oFotografia    = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

        $rpta = DB::select('call sp_Usuario_setRegistrarUsuario ( ?, ?, ?, ?, ?, ?, ?)', [
            $cPrimerNombre,
            $cSegundoNombre,
            $cApellido,
            $cUsuario,
            $cCorreo ,
            $cContrasena,
            $oFotografia
        ]);
        return $rpta[0]->nIdUsuario;
    }
    public function setEditarUsuario(Request $request){
        if(!$request->ajax()) return redirect('/');

        
        $nIdUsuario     = $request->nIdUsuario;
        $cPrimerNombre  = $request->cPrimerNombre;
        $cSegundoNombre = $request->cSegundoNombre;
        $cApellido      = $request->cApellido;
        $cUsuario       = $request->cUsuario;
        $cCorreo        = $request->cCorreo;
        $cContrasena    = $request->cContrasena;
        if($cContrasena != NULL){
            $cContrasena    = Hash::make($request->cContrasena);
        }
        $oFotografia    = $request->oFotografia;

        $nIdUsuario  = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
        $cPrimerNombre  = ($cPrimerNombre == NULL) ? ($cPrimerNombre = '') : $cPrimerNombre;
        $cSegundoNombre = ($cSegundoNombre == NULL) ? ($cSegundoNombre = '') : $cSegundoNombre;
        $cApellido      = ($cApellido == NULL) ? ($cApellido = '') : $cApellido;
        $cUsuario       = ($cUsuario == NULL) ? ($cUsuario = '') : $cUsuario;
        $cCorreo        = ($cCorreo == NULL) ? ($cCorreo = '') : $cCorreo;
        $cContrasena    = ($cContrasena == NULL) ? ($cContrasena = '') : $cContrasena;
        $oFotografia    = ($oFotografia == NULL) ? ($oFotografia = NULL) : $oFotografia;

        DB::select('call sp_Usuario_setEditarUsuario (?, ?, ?, ?, ?, ?, ?, ?)', [
            $nIdUsuario,
            $cPrimerNombre,
            $cSegundoNombre,
            $cApellido,
            $cUsuario,
            $cCorreo ,
            $cContrasena,
            $oFotografia
        ]);
    }
    public function setCambiarEstadoUsuario(Request $request){
        if(!$request->ajax()) return redirect('/');

        
        $nIdUsuario     = $request->nIdUsuario;
        $cEstado     = $request->cEstado;

        $nIdUsuario    = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
        $cEstado    = ($cEstado == NULL) ? ($cEstado = '') : $cEstado;

        DB::select('call sp_Usuario_setCambiarEstadoUsuario (?, ?)', [
            $nIdUsuario,
            $cEstado
        ]);
    }

    public function setEditarRolByUsuario(Request $request){
        if(!$request->ajax()) return redirect('/');
         
        $nIdUsuario     = $request->nIdUsuario;
        $nIdRol     = $request->nIdRol;

        $nIdUsuario    = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;
        $nIdRol    = ($nIdRol == NULL) ? ($nIdRol = '') : $nIdRol;

        DB::select('call sp_Usuario_setEditarRolByUsuario (?, ?)', [
            $nIdUsuario,
            $nIdRol
        ]);
    }

    public function getRolByUsuario(Request $request){
        if(!$request->ajax()) return redirect('/');
         
        $nIdUsuario     = $request->nIdUsuario;
        
        $nIdUsuario    = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;

        $rpta = DB::select('call sp_Usuario_getRolByUsuario (?)', [
            $nIdUsuario
        ]);
        return $rpta;
    }

    public function getListarPermisosByRolAsignado(Request $request){
        if(!$request->ajax()) return redirect('/');
        $nIdUsuario     = $request->nIdUsuario;
        
        $nIdUsuario    = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;

        $rpta = DB::select('call sp_Usuario_getListarPermisosByRolAsignado (?)', [
            $nIdUsuario
        ]);
        return $rpta;
    }

    public function getListarPermisosByUsuario(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $nIdUsuario     = $request->nIdUsuario;
        
        $nIdUsuario    = ($nIdUsuario == NULL) ? ($nIdUsuario = '') : $nIdUsuario;

        $rpta = DB::select('call sp_Usuario_getListarPermisosByUsuario (?)', [
            $nIdUsuario
        ]);
        return $rpta;
    }
    public function setRegistrarPermisosByUsuario(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $nIdUsuario     = $request->nIdUsuario;
        
        $nIdUsuario    = ($nIdUsuario == NULL) ? ($nIdUsuario = 0) : $nIdUsuario;

        try{
            DB::beginTransaction();
            DB::select('call sp_Usuario_setEliminarPermisosByUsuario( ?)', [
                $nIdUsuario
            ]);
    
            
            $listPermisos = $request->listPermisosFilter;
            $listPermisosSize = sizeof($listPermisos);
            if($listPermisosSize > 0){
                foreach($listPermisos as $key => $value){
                    if($value['checked'] == true){
                        DB::select('call sp_Usuario_setRegistrarPermisosByUsuario (?, ?)',[
                            $nIdUsuario,
                            $value['id']
                        ]);
                    }
                }
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
    }
}
