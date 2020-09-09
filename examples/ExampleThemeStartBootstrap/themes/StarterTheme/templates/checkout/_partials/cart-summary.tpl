{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<section id="js-checkout-summary" class="js-cart js-checkout-summary" data-refresh-url="{url entity='cart' params=['ajax' => 1]}">
  {block name='hook_checkout_summary_top'}
    {hook h='displayCheckoutSummaryTop'}
  {/block}

  {block name='cart_summary_header'}
    <header>
      <h1 class="h3">{l s='Your order' d='Shop.Theme.Customeraccount'}</h1>
      <p>{$cart.summary_string}</p>
    </header>
  {/block}

  {block name='cart_summary_product_list'}
    <div id="cart-summary-product-list">
      <ul>
        {foreach from=$cart.products item=product}
          <li>{include file='checkout/_partials/cart-summary-product-line.tpl' product=$product}</li>
        {/foreach}
      </ul>
    </div>
  {/block}

  {block name='cart_voucher'}
    {include file='checkout/_partials/cart-voucher.tpl'}
  {/block}

  {block name='cart_totals'}
    {include file='checkout/_partials/cart-summary-totals.tpl' cart=$cart}
  {/block}
</section>
