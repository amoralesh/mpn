<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

        /* CUSTOM */ 
        use Illuminate\Session\TokenMismatchException;
        use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
        use ErrorException;
        use InvalidArgumentException;
        use ModelNotFoundException;
        use ReflectionException;
        use FatalThrowableError;
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Http\Request;
 
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function render($request, Exception $e)
    {     
        if( !config('app.debug') ) 
        {   
            // ModelNotFoundException (modelo no encontrado)
            if ($e instanceof ModelNotFoundException)
            {
                $data = array('code' => 401, 'title' => 'Modelo no encontrado ', 'message' => 'ModelNotFoundException' );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
            // ReflectionException (modelo no encontrado) se renderea dos veces pero es un bug del 5.3 https://github.com/laravel/framework/issues/17007
            else if ($e instanceof ReflectionException)
            {
                $data = array('code' => 402, 'title' => 'Modelo no encontrado ', 'message' => 'ReflectionException' );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
            // MethodNotAllowedHttpException
            else if( $e instanceof MethodNotAllowedHttpException )
            {
                $data = array('code' => 405, 'title' => 'Método no permitido', 'message' => 'MethodNotAllowedHttpException - tu petición no es la correcta - [GET,POST,PUT,DELETE,HEAD]' );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
            // TokenMismatchException
            else if( $e instanceof TokenMismatchException )
            {
                return redirect($request->fullUrl())->with('errores',"Oops! Al parecer no pudiste enviar la información en un tiempo muy largo, Por favor inténtalo de nuevo.");
            }
            // NOT FOUND
            else if( $e instanceof NotFoundHttpException )
            {
                $data = array('code' => 404, 'title' => 'Página no encontrada', 'message' => 'NotFoundHttpException - Revisa la url a la que intentas navegar' );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
            // FatalThrowableError
            else if( $e instanceof FatalThrowableError )
            {
                $data = array('code' => 500, 'title' => 'Error Interno', 'message' => 'FatalThrowableError' );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
            // ErrorException
            else if( $e instanceof ErrorException )
            {
                $data = array('code' => 500, 'title' => 'Error Interno', 'message' => 'ErrorException , Intenta cerrar el sistema y volverlo a abrir, si el problema persiste comunicate con el administrador.' 
                . " [ Mensaje: " . $e->getMessage() ." ] " );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
            // FatalErrorExceptions
            else if( $e instanceof InvalidArgumentException )
            {
                $data = array('code' => 500, 'title' => 'Error Interno', 'message' => 'ErrorException , Intenta cerrar el sistema y volverlo a abrir, si el problema persiste comunicate con el administrador.' 
                . " [ Mensaje: " . $e->getMessage() ." ] " );
                return \Response::view('errors.errores', $data , $data['code'] );
            }
        }
        return parent::render($request, $e);
    } 


    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $imei = $request->header('Imei');

        if( $imei != null){
            return response("No Autorizado", 401)->header('Content-Type', 'application/json');
        } else{
            return redirect()->guest('/');
        }
    }
}
