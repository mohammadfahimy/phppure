
<?php include BASEPATH .'/views/header.php' ;?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <img class="compare_loading" src="<?= ASSETURI ?>/img/Infinity-loading.svg" alt="">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <form action="<?php site_url('proje/cart/'); ?>" method="post">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php foreach($cartDetail as $key => $cart ): if(is_string($key))continue;  ?>
                            <tr>
                                <td class="align-middle"><img src="<?= $cart['image'] ?>" alt="" style="width: 50px;"> <?php echo $cart['id'] ?></td>
                                <td class="align-middle"><?= $cart['price'] ?></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto cart" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center cart-quantity" value="<?= $cart['attributes']['quantity'] ?>" data-product_id="<?= $key?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total_price_product"><?= $cart['subtotal'] ?></td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger"  name="removeProduct" value="<?= $key ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="<?php site_url('proje/cart/'); ?>" method="post">
                    <div class="input-group">
                        <input type="text" name="couponcode" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary" name="couponsend">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="sub-total d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?= $cartTotal ?> تومان</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2 total_cart">
                            <h5>Total</h5>
                            <h5>تومان <?php
                            echo empty($discount) ? $cartTotal : $discount ; ?></h5>
                        </div>
                        <a href="<?= site_url('proje/checkoute/'); ?>" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


    <?php include BASEPATH .'/views/footer.php' ?>