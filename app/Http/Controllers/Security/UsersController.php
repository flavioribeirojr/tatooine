<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Security\UserRequest;
use App\Repositories\Security\UserRepository;

class UsersController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();

            $userCreated = $this->userRepository->create($data);

            return redirect(baseUrl('/users'))->with('message', 'Usuário cadastrado com sucesso');
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->back()->withErrors(['exception' => config('custom.exception')]);
        }
    }

    public function edit($userId)
    {
        $user = $this->userRepository->find($userId);
        
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Usuário não existe']);
        }

        return view('users.edit', compact('user'));
    }

    public function update($userId, UserRequest $request)
    {
        try {
            $user = $this->userRepository->find($userId);
            
            if (!$user) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Usuário não existe']);
            }

            $data = $request->only($this->userRepository->getFillable());
            
            $this->userRepository->update($user->usr_id, $data);

            return redirect(baseUrl('/users'))->with('message', 'Usuário atualizado com sucesso');
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return redirect()->back()->withErrors(['exception' => config('custom.exception')]);
        }
    }

    public function delete($userId)
    {
        try {
            $user = $this->userRepository->find($userId);
            
            if (!$user) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Usuário não existe']);
            }
    
            $user->delete();
    
            return response(['message' => 'Usuário excluído com sucesso'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                throw $e;
            }

            return response(['exception' => config('custom.exception')], 500);
        }
    }
}
