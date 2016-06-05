<?php

namespace ProjectNpx\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        // Checa se o usuário está logado.
        if ($this->auth->check()) {
            // Uma vez que estamos logado, e temos uma instância de um usuário, podemos verificar o campo dele is_admin
            if ($this->auth->user()->is_admin) {
                // vai para o próximo middleware
                return $next($request);
            } else {
                return response('Você não é administrador.', 401);
            }
        } else {
            return redirect()->guest('auth/login');
        }
    }
}
