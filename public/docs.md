FORMAT: 1A

# Piu Api Demo

# authorizations [/authorizations]
Authorizations 登录授权

## 应用登录授权 [POST /authorizations]
使用账号和密码登录

+ Request (application/json)
    + Body

            {
                "username": "piu",
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

# orders [/orders]
Orders 订单

## 订单列表 [POST /orders{?page,limit}]
需要用户登录

+ Request (application/json)
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "access_token": "abc..",
                "token_type": "Bearer",
                "expires_in": 3600
            }