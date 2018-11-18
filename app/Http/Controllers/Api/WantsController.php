<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\IRequest;
use App\Http\Requests\Api\LocateRequest;
use App\Http\Requests\Api\WantsRequest;
use App\Http\Requests\Request;
use App\Models\Location;
use App\Models\Store\Want;
use App\Services\LocationService;
use App\Transformers\WantTransformer;
use Dingo\Api\Auth\Auth;

/**
 * 帮住
 *
 * @Resource("wants", uri="/wants")
 */
class WantsController extends Controller
{
    /**
     * 帮住
     *
     * 帮住列表
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Request({"lat": "70", "lng": 60})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function index(WantsRequest $request, Want $want)
    {
        $keywords = $request->keywords;
        $category_id = $request->category_id;
        $location_id = $request->location_id;


        $builder = $want->query();

        if($category_id){
            $builder = $builder->where("category_id", $category_id);
        }
        if($location_id){
            $builder = $builder->where("location_id", $location_id);
        }
        if($keywords){
            $builder = $builder->where("name", "like", "%{$keywords}%");
        }

        // order 参数用来排序
        if ($order = $request->input('order', '')) {
            $builder = $builder->orderBy($order, $request->input('orderway'));
        }

        $wants = $builder->paginate($request->input("per_page", 10));

        return $this->response->paginator($wants, new WantTransformer());
    }

    /**
     * 我想买
     *
     * 新增求购信息
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Request({"lat": "70", "lng": 60})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function store(WantsRequest $request, Want $want)
    {
        $want->fill($request->all());
        if($this->user()){
            $want->user_id = $this->user()->id;
        }
        dd($request->input());
        $want->save();
        //attributes
        $attributes = [];
        foreach ($attributes as $k => $key){
            if($request->$key){
                $want->setAttribute($key, $request->$key);
            }
        }
        return $this->response->item($want, new WantTransformer())
            ->setStatusCode(200);
    }

    /**
     * 我想买
     *
     * 求购信息详情
     *
     * @Get("/:id")
     * @Versions({"v1"})
     * @Request({"lat": "70", "lng": 60})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function show(Want $want)
    {
        return $this->response->item($want, new WantTransformer());
    }
}
