FORMAT: 1A

# Piu Api Demo

# captchas [/captchas]
图片验证码

## 图片验证码 [POST /captchas]
获取验证码图片

+ Request (application/json)
    + Body

            {
                "username": "piuio",
                "password": "******"
            }

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 图片验证码 [POST /captchas/verify]
验证验证码图片

+ Request (application/json)
    + Body

            {
                "username": "piuio",
                "password": "******"
            }

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

# users [/users]
注册登录用户相关接口模块

## 用户注册 [POST /users]


+ Request (application/json)
    + Body

            {
                "name": "piuio",
                "password": "******"
            }

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 短信验证码登录 [POST /users/sms/login]


+ Request (application/json)
    + Body

            {
                "phone": "piuio",
                "verification_key": "foo",
                "verification_code": "1234"
            }

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

# authorizations [/authorizations]
授权认证

## 授权认证 [POST /authorizations]
使用账号和密码登录

+ Request (application/json)
    + Body

            {
                "username": "piuio",
                "password": "******"
            }

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 第三方登录授权 [POST /authorizations/socials/{social_type}]
支持微信等第三方登录授权验证

+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 刷新Token [PUT /authorizations]
token有效期1小时

+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 退出登录 [DELETE /authorizations]
销毁token

+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

# shop/coupons [/shop/coupons]
店铺优惠券

## 获取店铺优惠券列表 [POST /shop/coupons]


+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 9,
                    "user_id": 1015,
                    "coupon_id": "1",
                    "extra": null,
                    "enable": null,
                    "coupon": {
                        "data": {
                            "id": 1,
                            "name": "5元优惠券",
                            "description": "满10减5",
                            "type": "fixed",
                            "value": "5.00",
                            "min_amount": "10.00",
                            "created_at": "-0001-11-30 00:00:00"
                        }
                    }
                }
            }

## 发布优惠券 [POST /shop/coupons]


+ Request (application/json)
    + Body

            {
                "coupon_id": "1"
            }

+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 9,
                    "shop_id": 1015,
                    "coupon_id": "1",
                    "extra": null,
                    "enable": null,
                    "coupon": {
                        "data": {
                            "id": 1,
                            "name": "5元优惠券",
                            "description": "满10减5",
                            "type": "fixed",
                            "value": "5.00",
                            "min_amount": "10.00",
                            "created_at": "-0001-11-30 00:00:00"
                        }
                    }
                }
            }

## 查看店铺优惠券 [POST /shop/coupons/{coupon_id}]


+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 1,
                    "name": "5元优惠券",
                    "description": "满10减5",
                    "type": "fixed",
                    "value": "5.00",
                    "min_amount": "10.00",
                    "created_at": "-0001-11-30 00:00:00"
                }
            }

# orders [/orders]
Orders 订单

## 订单列表 [POST /orders{?page,limit}]
需要用户登录

+ Parameters
    + page: (string, optional) - 分页数
        + Default: 1
    + limit: (string, optional) - 分页大小
        + Default: 10

+ Response 200 (application/json)
    + Body

            {
                "id": 1604,
                "no": "20180801170525710129",
                "user_id": 1015,
                "address": {
                    "address": "江苏省南京市浦口区第77街道第435号",
                    "zip": 67000,
                    "contact_name": "官秀兰",
                    "contact_phone": "18382361372"
                },
                "total_amount": "12330.00",
                "remark": null,
                "paid_at": null,
                "coupon_id": null,
                "payment_method": null,
                "payment_no": null,
                "refund_status": "pending",
                "refund_no": null,
                "closed": true,
                "reviewed": false,
                "ship_status": "pending",
                "ship_data": null,
                "extra": null,
                "created_at": "2018-08-01 17:05:25",
                "updated_at": "2018-08-01 17:05:25"
            }

## 订单详情 [POST /orders/{id}]
根据订单id获取订单详情

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 订单创建 [POST /orders]


+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

# user/coupons [/user/coupons]
用户优惠券

## 用户优惠券 [POST /user/coupons]
获取用户优惠券列表

+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }

## 领取优惠券 [POST /user/coupons]


+ Request (application/json)
    + Body

            {
                "coupon_id": "1"
            }

+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 9,
                    "user_id": 1015,
                    "coupon_id": "1",
                    "extra": null,
                    "enable": null,
                    "coupon": {
                        "data": {
                            "id": 1,
                            "name": "5元优惠券",
                            "description": "满10减5",
                            "type": "fixed",
                            "value": "5.00",
                            "min_amount": "10.00",
                            "created_at": "-0001-11-30 00:00:00"
                        }
                    }
                }
            }

## 查看优惠券 [POST /user/coupons/{coupon_id}]


+ Request (application/json)

+ Response 200 (application/json)
    + Body

            {
                "data": {
                    "id": 1,
                    "name": "5元优惠券",
                    "description": "满10减5",
                    "type": "fixed",
                    "value": "5.00",
                    "min_amount": "10.00",
                    "created_at": "-0001-11-30 00:00:00"
                }
            }