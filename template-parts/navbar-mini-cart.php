<a href="#" class="nav-link mini-cart-icon">
  <i class="bi bi-bag fs-4"></i>
  <?php global $woocommerce; ?>
  <?php echo '<span class="mini-cart-counter">' . $woocommerce->cart->cart_contents_count . '</span>'; ?>
</a>
<div class="navbar-mini-cart">
  <?php echo '<h5>' . __('Basket', 'yellowbox')  . '</h5>'; ?>
  <?php echo woocommerce_mini_cart(); ?>
</div>
