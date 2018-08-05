@extends('layouts.app')
@section('title', $shop->title)

@section('content')
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-3">
        <img class="cover" src="{{ $shop->logo_url }}" alt="">
      </div>
      <div class="col-sm-7">
        <div class="title">{{ $shop->name }}</div>
        <div class="buttons" style="float:right">
          @if($favored)
            <button class="btn btn-danger btn-disfavor">取消收藏</button>
          @else
            <button class="btn btn-success btn-favor">❤ 收藏</button>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <form action="{{ route('products.index') }}" class="form-inline search-form">
        <input type="text" class="form-control input-sm" name="search" placeholder="搜索">
        <button class="btn btn-primary btn-sm">搜索</button>
        <select name="order" class="form-control input-sm pull-right">
          <option value="">排序方式</option>
          <option value="price_asc">价格从低到高</option>
          <option value="price_desc">价格从高到低</option>
          <option value="sold_count_desc">销量从高到低</option>
          <option value="sold_count_asc">销量从低到高</option>
          <option value="rating_desc">评价从高到低</option>
          <option value="rating_asc">评价从低到高</option>
        </select>
      </form>
    </div>
    <div class="row products-list">
      @foreach($products as $product)
        <div class="col-xs-3 product-item">
          <div class="product-content">
            <div class="top">
              <div class="img">
                <a href="{{ route('products.show', ['product' => $product->id]) }}">
                  <img src="{{ $product->image_url }}" alt="">
                </a>
              </div>
              <div class="price"><b>￥</b>{{ $product->price }}</div>
              <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a>
            </div>
            <div class="bottom">
              <div class="sold_count">销量 <span>{{ $product->sold_count }}笔</span></div>
              <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="pull-right">{{ $products->appends($filters)->render() }}</div>
  </div>
</div>
</div>
</div>
@endsection

@section('scriptsAfterJs')
<script>
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
    $('.sku-btn').click(function () {
      $('.product-info .price span').text($(this).data('price'));
      $('.product-info .stock').text('库存：' + $(this).data('stock') + '件');
    });

    $('.btn-favor').click(function () {
      axios.post('{{ route('products.favor', ['product' => $shop->id]) }}')
        .then(function () {
          swal('操作成功', '', 'success')
          .then(function () {  // 这里加了一个 then() 方法
              location.reload();
            });
        }, function(error) {
          if (error.response && error.response.status === 401) {
            swal('请先登录', '', 'error');
          } else if (error.response && error.response.data.msg) {
            swal(error.response.data.msg, '', 'error');
          } else {
            swal('系统错误', '', 'error');
          }
        });
    });

    $('.btn-disfavor').click(function () {
      axios.delete('{{ route('products.disfavor', ['product' => $shop->id]) }}')
        .then(function () {
          swal('操作成功', '', 'success')
            .then(function () {
              location.reload();
            });
        });
    });

    // 加入购物车按钮点击事件
    $('.btn-add-to-cart').click(function () {
      // 请求加入购物车接口
      axios.post('{{ route('cart.add') }}', {
        sku_id: $('label.active input[name=skus]').val(),
        amount: $('.cart_amount input').val(),
      })
        .then(function () { // 请求成功执行此回调
          swal('加入购物车成功', '', 'success')
            .then(function() {
              location.href = '{{ route('cart.index') }}';
            });
        }, function (error) { // 请求失败执行此回调
          if (error.response.status === 401) {
            // http 状态码为 401 代表用户未登陆
            swal('请先登录', '', 'error');
          } else if (error.response.status === 422) {
            // http 状态码为 422 代表用户输入校验失败
            var html = '<div>';
            _.each(error.response.data.errors, function (errors) {
              _.each(errors, function (error) {
                html += error+'<br>';
              })
            });
            html += '</div>';
            swal({content: $(html)[0], icon: 'error'})
          } else {
            // 其他情况应该是系统挂了
            swal('系统错误', '', 'error');
          }
        })
    });

  });
</script>
@endsection
