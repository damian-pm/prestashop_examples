{block name='product_miniature_item'}


  {* <article class="product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
    {block name='product_thumbnail'}
      <a href="{$product.url}" class="thumbnail product-thumbnail">
        <img
          src = "{$product.cover.medium.url}"
          alt = "{$product.cover.legend}"
          data-full-size-image-url = "{$product.cover.large.url}"
        >
      </a>
    {/block}

    {block name='product_name'}
      <h1 class="h2" itemprop="name"><a href="{$product.url}">{$product.name}</a></h1>
    {/block}

    {block name='product_description_short'}
      <div class="product-description-short" itemprop="description">{$product.description_short nofilter}</div>
    {/block}

    {block name='product_list_actions'}
      <div class="product-list-actions">
        {if $product.add_to_cart_url}
            <a
              class = "add-to-cart"
              href  = "{$product.add_to_cart_url}"
              rel   = "nofollow"
              data-id-product="{$product.id_product}"
              data-id-product-attribute="{$product.id_product_attribute}"
              data-link-action="add-to-cart"
            >{l s='Add to cart' d='Shop.Theme.Actions'}</a>
        {/if}
        {hook h='displayProductListFunctionalButtons' product=$product}
      </div>
    {/block}

    {block name='product_quick_view'}
      <a href="#">quickView</a>
    {/block}

    {block name='product_variants'}
      {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
    {/block}

    {block name='product_price_and_shipping'}
      {if $product.show_price}
        <div class="product-price-and-shipping">
          {if $product.has_discount}
            {hook h='displayProductPriceBlock' product=$product type="old_price"}

            <span class="regular-price">{$product.regular_price}</span>
            {if $product.discount_type === 'percentage'}
              <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
            {elseif $product.discount_type === 'amount'}
              <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
            {/if}
          {/if}

          {hook h='displayProductPriceBlock' product=$product type="before_price"}

          <span itemprop="price" class="price">{$product.price}</span>

          {hook h='displayProductPriceBlock' product=$product type="unit_price"}

          {hook h='displayProductPriceBlock' product=$product type="weight"}
        </div>
      {/if}
    {/block}

    {block name='product_flags'}
      <ul class="product-flags">
        {foreach from=$product.flags item=flag}
          <li class="{$flag.type}">{$flag.label}</li>
        {/foreach}
      </ul>
    {/block}

    {block name='product_availability'}
      {if $product.show_availability}
        <span class='product-availability {$product.availability}'>{$product.availability_message}</span>
      {/if}
    {/block}

    {hook h='displayProductListReviews' product=$product}

  </article> *}
  {* <article  data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product"> *}

  <div class="card car-product-box">
  {block name='product_thumbnail'}
      <img
        src = "{$product.cover.medium.url}"
        alt = "{$product.cover.legend}"
        data-full-size-image-url = "{$product.cover.large.url}"
        class="card-img"
      >
  {/block}

  <div class="card-body">
    {block name='product_name'}
      {* <h1 class="h2" itemprop="name"><a href="{$product.url}">{$product.name}</a></h1> *}
      <h4 class="card-title"><a href="{$product.url}">{$product.name}</a></h4>
    {/block}
    {* <h6 class="card-subtitle mb-2 text-muted">Style: VA33TXRJ5</h6> *}

    <p class="card-text">
    {block name='product_availability'}
      {if $product.show_availability}
        <span class='product-availability {$product.availability}'>{$product.availability_message}</span>
      {/if}
    {/block}

    {hook h='displayProductListReviews' product=$product}
    </p>
    <p class="card-text">

    {block name='product_quick_view'}{/block}

    {block name='product_flags'}
        {foreach from=$product.flags item=flag}
          <span class="badge badge-success {$flag.type}">{$flag.label}</span>
        {/foreach}
    {/block} 
    {block name='product_variants'}
      {include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
    {/block}

    </p>
    <p class="card-text">
    {block name='product_description_short'}
      {$product.description_short nofilter}
    {/block}
     </p>
    <div class="options d-flex flex-fill">
       {* <select class="custom-select mr-1">
          <option selected>Color</option>
          <option value="1">Green</option>
          <option value="2">Blue</option>
          <option value="3">Red</option>
      </select> *}
      <select class="custom-select ml-1">
          <option selected>Size</option>
          <option value="1">41</option>
          <option value="2">42</option>
          <option value="3">43</option>
      </select>
    </div>
    <div class="buy d-flex justify-content-between align-items-center">

    {block name='product_price_and_shipping'}
      {if $product.show_price}
        {* <div class="product-price-and-shipping"> *}

          {if $product.has_discount}
            {hook h='displayProductPriceBlock' product=$product type="old_price"}
            <span class="regular-price">{$product.regular_price}</span>
            {* {if $product.discount_type === 'percentage'}
              <span class="discount-percentage discount-product">{$product.discount_percentage}</span>
            {elseif $product.discount_type === 'amount'}
              <span class="discount-amount discount-product">{$product.discount_amount_to_display}</span>
            {/if} *}
          {/if}
          <div class="price text-success"><h4 class="mt-4">{$product.price}</h4></div>

          {* <span itemprop="price" class="price">{$product.price}</span> *}

          {hook h='displayProductPriceBlock' product=$product type="before_price"}
          {hook h='displayProductPriceBlock' product=$product type="unit_price"}
          {hook h='displayProductPriceBlock' product=$product type="weight"}
        {* </div> *}
      {/if}
    {/block}

      {if $product.add_to_cart_url}

        {if $product.add_to_cart_url}
            <a
              class = "btn btn-danger"
              href  = "{$product.add_to_cart_url}"
              rel   = "nofollow"
              data-id-product="{$product.id_product}"
              data-id-product-attribute="{$product.id_product_attribute}"
              data-link-action="add-to-cart"
            >{l s='Add to cart' d='Shop.Theme.Actions'}</a>
        {/if}
      {/if}
       {hook h='displayProductListFunctionalButtons' product=$product}
    </div>
  </div>
</div>

{/block}