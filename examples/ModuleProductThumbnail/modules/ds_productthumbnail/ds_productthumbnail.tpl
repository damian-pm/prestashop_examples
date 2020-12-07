<div>
<h3>photothumbnail: {$product.images|@count} </h3>
<div class="hidden" id="product-images-list">
{foreach from=$product.images item=image}
    <img src="{$image.bySize.medium_default.url}" />
  {/foreach}
</div>
<div id="app"></div>
</div>