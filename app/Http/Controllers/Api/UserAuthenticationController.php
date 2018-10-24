<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InternalException;
use App\Http\Requests\Api\IRequest;
use App\Http\Requests\Api\UserAuthenticationRequest;
use App\Http\Requests\Api\UserFavoriteRequest;
use App\Http\Resources\User;
use App\Models\UserAuthentication;
use App\Models\UserFavorite;
use App\Services\UserService;
use App\Transformers\UserFavoritesTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Http\Requests\UserAddressRequest;

class UserAuthenticationController extends Controller
{
    //我的认证
    public function index(IRequest $request, UserAuthentication $userAuthentication)
    {
        $authentications = [];
        $items = $userAuthentication->getAuthentications($this->user()->id);
        $types = ['identity','company', 'qualification', 'field'];
        foreach ($types as $type){
            $authentications[$type] = [
                'status' => UserAuthentication::STATUS_PENDING,
                'status_desc' => $userAuthentication->getStatusDesc(UserAuthentication::STATUS_PENDING),
            ];
        }
        if($items){
            foreach ($items as $item){
                $authentications[$item->type]['name'] = $item->name;
                $authentications[$item->type]['number'] = $item->number;
                $authentications[$item->type]['front'] = $item->front;
                $authentications[$item->type]['back'] = $item->back;
                $authentications[$item->type]['status'] = $item->status;
                $authentications[$item->type]['status_desc'] = $item->getStatusDesc($item->status);
                $authentications[$item->type]['created_at'] = $item->created_at->toDateTimeString();
            }
        }

        return response()->json($authentications);
    }

    public function store(UserAuthenticationRequest $request, UserAuthentication $userAuthentication)
    {
        $type = $request->type;
        switch ($type){
            case 'identity':
                $rules['name'] = 'required|string';
                $rules['number'] = 'required|string';
                $rules['front'] = 'required|string';
                $rules['back'] = 'required|string';
                break;
            case 'company':
                $rules['name'] = 'required|string';
                $rules['number'] = 'required|string';
                $rules['front'] = 'required|string';
                break;
            case 'qualification':
                $rules['front'] = 'required|string';
                break;
            case 'field':
                break;
        }
        $user = $this->user();
        if($userAuthentication->isVerified($user->id, $type)){
            throw new InternalException("用户已经认证");
        }
        $userAuthentication->add($user->id, $type, $request->name, $request->number, $request->front, $request->back);

        return $this->response->noContent();
    }
}
