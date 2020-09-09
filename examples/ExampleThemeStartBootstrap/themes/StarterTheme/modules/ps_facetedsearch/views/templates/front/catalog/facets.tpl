{**
  * 2007-2019 PrestaShop.
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
  * @copyright 2007-2019 PrestaShop SA
  * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
  * International Registered Trademark & Property of PrestaShop SA
  *}
{if $displayedFacets|count}
  <div id="search_filters">

    {block name='facets_clearall_button'}
      {if $activeFilters|count}
        {block name='facets_title'}
          <p class="text-uppercase h6 hidden-sm-down">{l s='Filter By' d='Shop.Theme.Actions'}</p>
        {/block}
        <div id="_desktop_search_filters_clear_all" class="hidden-sm-down clear-all-wrapper">
          <button data-search-url="{$clear_all_link}" class="btn btn-secondary js-search-filters-clear-all">
            {l s='Clear all' d='Shop.Theme.Actions'}
          </button>
        </div>
      {/if}
    {/block}
    <hr/>
    {foreach from=$displayedFacets item="facet"}
      <section class="facet clearfix">
        {* <p class="h6 facet-title hidden-sm-down">{$facet.label}</p> *}
        {assign var=_expand_id value=10|mt_rand:100000}
        {assign var=_collapse value=true}
        {foreach from=$facet.filters item="filter"}
          {if $filter.active}{assign var=_collapse value=false}{/if}
        {/foreach}

        <div class="col">
        <ul class="list-group" >
          <li class="list-group-item list-group-item-primary list-group-highlight">
            <a href="#" class="title hidden-md-up" data-target="#facet_{$_expand_id}" data-toggle="collapse"{if !$_collapse} aria-expanded="true"{/if}>
              <p class="h6 facet-title">{$facet.label}</p>
            </a>
            {* <p class="h6 facet-title">{$facet.label}</p> *}
          </li>
          <li  id="facet_{$_expand_id}" class="list-group collapse{if !$_collapse} in{/if}">
        {if in_array($facet.widgetType, ['radio', 'checkbox'])}

          {block name='facet_item_other'}
           
            <ul class="list-group" >
              {foreach from=$facet.filters key=filter_key item="filter"}
                {if !$filter.displayed}
                  {continue}
                {/if}

                <li class="list-group-item">

                <div class="custom-control custom-checkbox">

                    {if $facet.multipleSelectionAllowed}
                        <input
                          id="facet_input_{$_expand_id}_{$filter_key}"
                          data-search-url="{$filter.nextEncodedFacetsURL}"
                          type="checkbox"
                          class="custom-control-input"
                          {if $filter.active }checked{/if}
                        >
                        {if isset($filter.properties.color)}
                          <span class="color" style="background-color:{$filter.properties.color}"></span>
                        {elseif isset($filter.properties.texture)}
                          <span class="color texture" style="background-image:url({$filter.properties.texture})"></span>
                        {else}
                          <span {if !$js_enabled} class="ps-shown-by-js" {/if}><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
                        {/if}
                    {else}
                        <input
                          id="facet_input_{$_expand_id}_{$filter_key}"
                          data-search-url="{$filter.nextEncodedFacetsURL}"
                          type="radio"
                          class="custom-control-input"
                          name="filter {$facet.label}"
                          {if $filter.active }checked{/if}
                        >
                        <span {if !$js_enabled} class="ps-shown-by-js" {/if}></span>
                    {/if}

                  <label class="custom-control-label facet-label{if $filter.active} active {/if}" for="facet_input_{$_expand_id}_{$filter_key}">
                    <a
                      href="{$filter.nextEncodedFacetsURL}"
                      class="_gray-darker search-link js-search-link"
                      rel="nofollow"
                    >
                      {$filter.label}
                      {if $filter.magnitude and $show_quantities}
                        <span class="magnitude">({$filter.magnitude})</span>
                      {/if}
                    </a>
                  </label>

                  </div>
                </li>
              {/foreach}
            </ul>
          {/block}

        {elseif $facet.widgetType == 'dropdown'}
          {block name='facet_item_dropdown'}
            <ul id="facet_{$_expand_id}" class="collapse{if !$_collapse} in{/if}">
              <li>
                <div class="col-sm-12 col-xs-12 col-md-12 facet-dropdown dropdown">
                  <a class="select-title" rel="nofollow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {$active_found = false}
                    <span>
                      {foreach from=$facet.filters item="filter"}
                        {if $filter.active}
                          {$filter.label}
                          {if $filter.magnitude and $show_quantities}
                            ({$filter.magnitude})
                          {/if}
                          {$active_found = true}
                        {/if}
                      {/foreach}
                      {if !$active_found}
                        {l s='(no filter)' d='Shop.Theme.Global'}
                      {/if}
                    </span>
                    <i class="material-icons float-xs-right">&#xE5C5;</i>
                  </a>
                  <div class="dropdown-menu">
                    {foreach from=$facet.filters item="filter"}
                      {if !$filter.active}
                        <a
                          rel="nofollow"
                          href="{$filter.nextEncodedFacetsURL}"
                          class="select-list"
                        >
                          {$filter.label}
                          {if $filter.magnitude and $show_quantities}
                            ({$filter.magnitude})
                          {/if}
                        </a>
                      {/if}
                    {/foreach}
                  </div>
                </div>
              </li>
            </ul>
          {/block}

        {elseif $facet.widgetType == 'slider'}
          {block name='facet_item_slider'}
            {foreach from=$facet.filters item="filter"}
              <ul id="facet_{$_expand_id}"
                class="faceted-slider collapse{if !$_collapse} in{/if} margin-m"
                data-slider-min="{$facet.properties.min}"
                data-slider-max="{$facet.properties.max}"
                data-slider-id="{$_expand_id}"
                data-slider-values="{$filter.value|@json_encode}"
                data-slider-unit="{$facet.properties.unit}"
                data-slider-label="{$facet.label}"
                data-slider-specifications="{$facet.properties.specifications|@json_encode}"
                data-slider-encoded-url="{$filter.nextEncodedFacetsURL}"
              >
                <li>
                  <p id="facet_label_{$_expand_id}">
                    {$filter.label}
                  </p>

                  <div id="slider-range_{$_expand_id}"></div>
                </li>
              </ul>
            {/foreach}
          {/block}
        {/if}
        </li>
        </ul>
        <div>
      </section>
    {/foreach}
  </div>
{/if}
