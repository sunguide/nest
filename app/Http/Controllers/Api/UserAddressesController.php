<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InternalException;
use App\Http\Requests\Api\UserAuthenticationRequest;
use App\Http\Requests\UserAddressRequest;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserAuthentication;
use App\Transformers\UserAddressTransformer;

class UserAddressesController extends Controller
{
    //我的收货地址
    public function index(User $user)
    {
        $userId = $user->id;
        if($userId != $this->user()->id){
            throw new InternalException("当前用户无权限获取别人的收货地址");
        }
        $items = UserAddress::query()->where("user_id", $userId)->get();
        return $this->response->collection($items, new UserAddressTransformer());
    }

    public function store(UserAddressRequest $request, UserAddress $userAddress)
    {
        $userAddress->fill($request->all());
        $userAddress->user_id = $this->user()->id;
        $userAddress->save();
        return $this->response->item($userAddress, new UserAddressTransformer())->setStatusCode(201);
    }

    public function update(UserAddressRequest $request, User $user, UserAddress $address)
    {
        if($address->user_id != $this->user()->id){
            throw new InternalException("无权限");
        }
        $address->update($request->all());
        return $this->response->item($address, new UserAddressTransformer());
    }
    public function destroy(User $user, UserAddress $address)
    {
        if($address->user_id != $this->user()->id){
            throw new InternalException("无权限");
        }
        $address->delete();
        return $this->response->noContent();
    }
}
