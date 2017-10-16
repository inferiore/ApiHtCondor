<?php
namespace App\Exceptions;
use Exception;
use Mail\Error;
use Modelos\Configuracion\User;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //dd(get_class($exception));
        if ($exception instanceof ModelNotFoundException)
        {
            return response([
                    'error' => 'No se encontro el recurso solicitado'
                ], 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException)
        {
            return response([
                    'error' => 'La Url y el verbo http  solicitada no se encuentra'
                ], 404);
        }
        if ($exception instanceof NotFoundHttpException)
        {
            return response([
                    'error' => 'No se encontro el recurso solicitado'
                ], 404);
        }
        // $user = User::where('email', 'rol_id', config('constantes.rol_administrador'))->first();
        // En caso que no cargue la pagina comentar esta linea
        // $user->notify(new \Notificaciones\ErrorNotificacion($exception));
        if($exception instanceof QueryException)
        {
            return response([
                    'error' => 'La petici&oacute;n del navegador no se ha podido completar porque se ha producido un error en la consulta.',
                    'debug' => $exception->getMessage()
                ], 409);
        }
        if($exception instanceof ErrorException)
        {
            return response([
                    'error' => 'La petici&oacute;n del navegador no se ha podido completar porque se ha producido un error en la consulta.',
                    'debug' => $exception->getMessage()
                ], 409);
        }
        
       
        // if(get_class($exception)=="ErrorException"){

        //     return response([
        //             'error' => $exception->getMessage(),
        //             'debug' => $exception->getMessage()
        //         ], 409);
        // }
        // if($exception instanceof Exception)
        // {
        //     return response([
        //             'status' => 'Internal Server Error',
        //             'error' => 'La solicitud del navegador no se ha podido completar porque se ha producido un error inesperado en el servidor.',
        //             'error' => $exception
        //         ], 500);
        // }
        
        return parent::render($request, $exception);
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
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Acceso no autorizado'], 401);
        }
         return response()->json(['error' => 'Acceso no autorizado'], 401);
        //return redirect()->guest(url('/'));
    }
}
