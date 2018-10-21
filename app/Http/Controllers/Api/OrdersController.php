<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CouponCodeUnavailableException;
use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Api\OrderRequest;
use App\Models\Coupon;
use App\Models\Store\Product;
use App\Models\UserAddress;
use App\Services\OrderService;
use App\Transformers\Store\OrderTransformer;
use App\Transformers\Store\ShopTransformer;
use Illuminate\Http\Request;
use App\Models\Store\Shop;
use App\Models\Store\OrderItem;
use App\Models\Store\Order;

/**
 * Orders 订单
 *
 * @Resource("orders", uri="/orders")
 */

class OrdersController extends Controller
{
    /**
     * 订单列表
     *
     * 需要用户登录
     *
     * @Post("/{?page,limit}")
     * @Parameters({
     *      @Parameter("page", description="分页数", default=1),
     *      @Parameter("limit", description="分页大小", default=10)
     * })
     * @Versions({"v1"})
     * @Response(200, body={"id":1604,"no":"20180801170525710129","user_id":1015,"address":{"address":"江苏省南京市浦口区第77街道第435号","zip":67000,"contact_name":"官秀兰","contact_phone":"18382361372"},"total_amount":"12330.00","remark":null,"paid_at":null,"coupon_id":null,"payment_method":null,"payment_no":null,"refund_status":"pending","refund_no":null,"closed":true,"reviewed":false,"ship_status":"pending","ship_data":null,"extra":null,"created_at":"2018-08-01 17:05:25","updated_at":"2018-08-01 17:05:25"})
     */

    public function index(Request $request)
    {
        $userId = \Auth::guard('api')->id();
        // 创建一个查询构造器
        $builder = Order::query()
            ->select("store_orders.*")
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $userId);
        if($request->input("no")){
            $builder = $builder->where("no", $request->input("no"));
        }
        // 判断是否有提交 keywords 参数，如果有就赋值给 $keywords 变量
        // keywords 参数用来模糊搜索商品
        if ($keywords = $request->input('keywords', '')) {
            $like = '%'.$keywords.'%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->leftJoin('store_order_items','store_order_items.order_id','=','store_orders.id');
            $builder->leftJoin('store_products','store_products.id','=','store_order_items.product_id');

            $builder->where(function ($query) use ($like) {
                $query->where('store_products.title', 'like', $like);
            });
        }
        $orders = $builder->paginate($request->input("per_page", 10));

        return $this->response->paginator($orders, new OrderTransformer());
    }

    /**
     * 订单详情
     *
     * 根据订单id获取订单详情
     *
     * @Post("/{id}")
     * @Versions({"v1"})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function show(Order $order, Request $request)
    {
        if (!$order) {
            throw new InvalidRequestException('订单不存在');
        }
        return $this->response->item($order, new OrderTransformer());
    }

    /**
     * 订单创建
     *
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Requests({"address_id":1,"items":[{"sku_id":1,"amount":1}],"remark":"订单备注"})
     * @Response(200, body=)
     */
    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user    = $request->user();
        $address = UserAddress::find($request->input('address_id'));
        $coupon  = null;
        if(!$address){
            throw  new InternalException("地址不存在");
        }else if($address->user_id != $user->id){
            throw  new InternalException("地址有误");
        }
        // 如果用户提交了优惠码
        if ($code_id = $request->input('coupon_id')) {
            $coupon = Coupon::find($request->input('coupon_id'));
            if (!$coupon) {
                throw new CouponCodeUnavailableException('优惠券不存在');
            }
        }

        $order =  $orderService->store($user, $address, $request->input('remark'), $request->input('items'), $coupon);
        return $this->response->array($order);
    }
}
