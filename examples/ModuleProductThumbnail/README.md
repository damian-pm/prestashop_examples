# Module Product Thumbnail

App mounted to product gallery photo and thumbnails, so you can turn pages like i demo flipbook

-- Not tested

### Usage
* https://github.com/ts1/flipbook-vue
    * demo : https://ts1.github.io/flipbook-vue/
* vue cli

### Install
[install module - look here](https://github.com/damian-pm/prestashop_examples/tree/master/SimpleInstall.md)

Add module to the hook 'displayAfterProductThumbs'.
For better look of products replace template content for example like this (classic theme):

**file name: /themes/classic/templates/catalog/_partials/product-cover-thumbnails.tpl**
```smarty
{* <div class="images-container">
  {block name='product_cover'}
    <div class="product-cover">
      {if $product.cover}
        <img class="js-qv-product-cover" src="{$product.cover.bySize.large_default.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" style="width:100%;" itemprop="image">
        <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
          <i class="material-icons zoom-in">&#xE8FF;</i>
        </div>
      {else}
        <img src="{$urls.no_picture_image.bySize.large_default.url}" style="width:100%;">
      {/if}
    </div>
  {/block}

  {block name='product_images'}
    <div class="js-qv-mask mask">
      <ul class="product-images js-qv-product-images">
        {foreach from=$product.images item=image}
          <li class="thumb-container">
            <img
              class="thumb js-thumb {if $image.id_image == $product.cover.id_image} selected {/if}"
              data-image-medium-src="{$image.bySize.medium_default.url}"
              data-image-large-src="{$image.bySize.large_default.url}"
              src="{$image.bySize.home_default.url}"
              alt="{$image.legend}"
              title="{$image.legend}"
              width="100"
              itemprop="image"
            >
          </li>
        {/foreach}
      </ul>
    </div>
  {/block}
</div> *}
{hook h='displayAfterProductThumbs'}
```
